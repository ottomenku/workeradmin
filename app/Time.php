<?php

namespace App;

use App\Traits\CalendaritemBaseFunc;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Time extends Model
{
    use CalendaritemBaseFunc;
    // use LogsActivity;
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'times';

    /**
     * The database primary key value
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $temp = [];
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['worker_id', 'timetype_id', 'datum', 'start', 'end', 'hour', 'adnote', 'worknote', 'pub'];

    public function timesToArr($items, $res = [])
    {
        foreach ($items as $item) {
            //  $itemArr=$item->toarray();
            $itemArr['hour'] = $item->hour;
            $itemArr['adnote'] = $item->adnote;
            $itemArr['worknote'] = $item->worknote;
            $itemArr['start'] = substr($item->start, 0, 5);
            $itemArr['end'] = substr($item->end, 0, 5);
            $itemArr['name'] = $item->timetype->name;
            $itemArr['color'] = $item->timetype->color;
            $itemArr['background'] = $item->timetype->background;
            $res[$item->worker_id][$item->datum][$item->id] = $itemArr;
        }
        return $res;
    }
    public function getTimesFromWorkers($data, $workers=[]) //App\Traits\CalendaritemBaseFunc
    {
        $res = [];
        foreach ($workers as $worker) {
            $where = $this->getWhere($data, $worker['id'], false);
            $res = $this->timesToArr($this->with('timetype')->where($where)->get(), $res);
            //$res['workerdays'][$wid] = $this->with($with)->where($where)->get();
        }
        return $res;
    }
    public function getTimesFromWorkerIds($data, $workerids) //App\Traits\CalendaritemBaseFunc
    {
        $res =[];
        foreach ($workerids as $wokerid) {
            $where = $this->getWhere($data, $wokerid, false);
            $res = $this->timesToArr($this->with('timetype')->where($where)->get(), $res);
            //$res['workerdays'][$wid] = $this->with($with)->where($where)->get();
        }
        return $res;
    }
    public function worker()
    {
        return $this->belongsTo('App\Worker');
        //return $this->belongsTo('App\Worker')->with('user');
    }
    public function timetype()
    {
        return $this->belongsTo('App\Timetype');
    }

    public function getDescriptionForEvent($eventName)
    {
        return __CLASS__ . " model has been {$eventName}";
    }
}
