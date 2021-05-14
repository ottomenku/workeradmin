<?php

namespace App\Traits;

use App\Daytype;
use App\Facades\CalendarHandler;
use App\Timetype;
use App\Worker;
use Spatie\Activitylog\Traits\LogsActivity;
trait CalendaritemBaseFunc
{

    public function getWhere($data,$wokerid, $justAllowed = false) //$justAllowed: true esetén csak a publikáltakat jeleníti meg
    {
        if (empty($data['start']) || empty($data['end'])) {$data = CalendarHandler::getStartEnd($data);}
           $where = [['datum', '>=', $data['start']],['worker_id', '=', $wokerid], ['datum', '<=', $data['end']]];
           if ($justAllowed) {$where[]=['pub', '>', 5];  }
        return $where;
    }



    public function hasGetItemRoleFromId($itemid, $modifyrole = false)
    {
        $item = $this->find($itemid);
        return $this->hasGetRole($item, $modifyrole);
    }

/**
 * worker és admin is használhatja
 */
    public function storeDays($par)
    {
        $this->storeItems($par, true);

    }
    /**
     * worker és admin is használhatja
     */
    public function storeItems($par, $uniq = false)
    {
        $store = false;
        $user = \Auth::user();

        $data = $par['formdata'];
        foreach ($par['workerids'] as $workerid) {
            $data['worker_id'] = $workerid;
            $data['pub'] = $user->level();
            $store = false;
            if ($user->hasRole('worker')) {$data['workerid'] = $user->getWorkerid();
                $store = true;
                $data['pub'] = 0;} elseif ($user->getCegid() == $user->getCegid($workerid)) {
                //     elseif($user->getCegid()== Worker::find($workerid)->ceg_id ) {

                $store = true;
                //  if($data['itemNote']){ $data['pub']=5; }
            }
            if ($store) {
                foreach ($par['datums'] as $datum) {
                    $data['datum'] = $datum;
                    if ($uniq) {
                        $item = $this->where(['datum' => $datum])->first();
                        if ($item) {$this->destroy($item->id);}

                        $timetype_id = Daytype::find($data['daytype_id'])->timetype_id;
                        $timetype = Timetype::find($timetype_id);
                        if ($timetype->basehour > 0) {
                            $dt = ['timetype_id' => $timetype_id, 'worker_id' => $workerid, 'datum' => $datum, 'start' => $timetype->start, 'end' => $timetype->end, 'hour' => $timetype->basehour, 'pub' => 50];
                            \App\Time::create($dt);
                        }

                    }
                    $data['worker_id'] = $workerid;
                    $this->create($data);
                }
            }
        }
        //return  $data;
    }

    public function delItem($data) // a datum tömb kelle legyen

    {
        if ($this->hasGetModifyRole($item)) {$item->destroy($data['id']);}
    }
    public function resetItem($data) // a datum tömb kelle legyen

    {
        foreach ($data['workerids'] as $workerid) {
            foreach ($data['datums'] as $datum) {
                $items = $this->where([['datum', '=', $datum], ['worker_id', '=', $workerid]])->get();
                foreach ($items as $item) {
                    if ($this->hasGetModifyRole($item)) {$item->destroy($item->id);}
                }
            }
        }
    }

//-NH*************************************************************

/**
 * A itemids tömbben lévő ideket engedélyezi ha a pub egyenlő 5ttel (ideiglenes) allowed lesz (level pub)
 * ha nullal le is másolja egyes pubbal . Lesz egy allowed (level pub) és egy allowedClose (1 -es pub)
 */
    public function allowitem($data) // a datum tömb kelle legyen

    {
        $user = \Auth::user();

        foreach ($data['itemids'] as $id) {
            $item = $this->findOrFail($id);

            if ($user->level() > 20 && $user->getCegid() == Worker::find($user->getWorkerid)->ceg_id) {
                if ($item->pub == 0) {
                    $item->pub = 1;
                    $item->save();
                    $item->pub = $user->level();
                    $this->create($item->toarray());
                } elseif ($item->pub == 5) {$item->pub = $user->level();
                    $item->save();}
            }
        }
        return $this->getitemsWithActMonth($data);
    }

public function hasGetRole($item, $modifyrole = false)
    {
    $user = \Auth::user();

    $workerid = $item->worker_id ?? 0;
    $cegid = $item->worker->ceg_id ?? 0;
    $res = false;
    if ($user->hasRole('worker')) {
        if ($user->getWorkerid() == $workerid) {$res = true;}
        if ($modifyrole && abs($item->pub) > 4) {$res = false;}
    } else {
        if ($user->getCegid() == $cegid) {$res = true;}
        if ($modifyrole && $user->level() < abs($item->pub)) {$res = false;}
    }
    return $res;
}
    public function hasGetModifyRole($item)
    {
        return $this->hasGetRole($item, true);
    }

    public function itemsToArr($items, $res = [])
    {
        //if(empty($res)){$res=['datekey'=>[],'idkey'=>[]];}
        foreach ($items as $item) {
            if ($item->pub == 0) {$class = 'new';} elseif ($item->pub == 1) {$class = 'allowedClose';} //worker bejegyzés elfogadás miatt lezárva
            elseif ($item->pub == 5) {$class = 'newAdmin';} //admin előírás
            elseif ($item->pub > 9) {$class = 'allowed';} //számfejthető
            elseif ($item->pub == -1) {$class = 'dontAllowedClose';} //worker bejegyzés elutasítás miatt lezárva
            else { $class = 'notallowed';}
            $itemArr = $item->toarray();
            $itemArr['start'] = substr($item->start, 0, 5);
            $itemArr['end'] = substr($item->end, 0, 5);
            $itemArr['class'] = $class;
            $res['datekey'][$item->worker_id][$item->datum][$item->id] = $itemArr;
            $res['idkey'][$item->id] = $itemArr;
        }

        return $res;
    }
 


/**
 * true val tér vissza ha az adott user lekérheti az adott időt vagy adott dolgozó vagy adott ceg idelyeit
 */
   public function hasGetitemRoleFromitemID($id)
    {
        $user = \Auth::user();
        $item = $this->find($id);
        $workerid = $item->worker_id ?? 0;
        $cegid = $item->worker->ceg_id ?? 0;

        if ($user->hasRole('worker')) {
            if ($user->getWorkerid() == $workerid && abs($item->pub) < 5) {return true;}
        } elseif ($user->level() >= abs($item->pub) && $user->getCegid() == $cegid) {return true;}

        return false;
    }
}
