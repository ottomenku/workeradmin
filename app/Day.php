<?php
namespace App;

use App\Traits\CalendaritemBaseFunc;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

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

    public function getDays($data) //App\Traits\CalendaritemBaseFunc
    {
        return $this->geItems($data, ['daytype', 'worker']);
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
