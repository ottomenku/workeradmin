<?php
namespace App;

use App\Traits\CalendaritemBaseFunc;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Daytype;
use App\Timetype;
class Day extends Model
{
 //   use LogsActivity;
    use SoftDeletes;
    use CalendaritemBaseFunc;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'days';
    protected $temp = [];
    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['daytype_id', 'worker_id', 'datum', 'note', 'pub'];


    public function daysToArr($items, $res = [])
    {
        foreach ($items as $item) {
            //  $itemArr=$item->toarray();
            $itemArr['icon'] = $item->hour;
            $itemArr['adnote'] = $item->adnote;
            $itemArr['worknote'] = $item->worknote;
            $itemArr['start'] = substr($item->start, 0, 5);
            $itemArr['end'] = substr($item->end, 0, 5);
            $itemArr['name'] = $item->daytype->name;
            $itemArr['color'] = $item->daytype->color;
            $itemArr['background'] = $item->daytype->background;;
            $itemArr['icon'] = $item->daytype->icon;
            $itemArr['workday'] = $item->daytype->workday;
            $res[$item->worker_id][$item->datum][$item->id] = $itemArr;
        }
        return $res;
    }

    public function getDaysFromWorkers($data, $workers=[]) //App\Traits\CalendaritemBaseFunc
    {
        $res = [];
        foreach ($workers as $worker) {
            $where = $this->getWhere($data, $worker['id'], false);
            $res = $this->daysToArr($this->with('daytype')->where($where)->get(), $res);
        }
        return $res;
    }

    public function getDaysFromWorkerIds($data, $workerids) //App\Traits\CalendaritemBaseFunc
    {
        $res = [];
        foreach ($workerids as $wokerid) {
            $where = $this->getWhere($data, $wokerid, false);
            $res = $this->daysToArr($this->with('daytype')->where($where)->get(), $res);
        }
        return $res;
    }



    public function daytype()
    {
        return $this->belongsTo('App\Daytype');
    }
    public function worker()
    {
        return $this->belongsTo('App\Worker');
    }
    public function getDescriptionForEvent($eventName)
    {
        return __CLASS__ . " model has been {$eventName}";
    }
}
