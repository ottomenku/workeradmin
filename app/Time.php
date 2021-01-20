<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use  App\Traits\CalendaritemBaseFunc ;
use Carbon\Carbon;
use App\Facades\CalendarHandler;
class Time extends Model
{  
    use CalendaritemBaseFunc ;
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
    protected $temp=[] ;
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['worker_id', 'timetype_id','datum', 'start', 'end', 'hour','adnote', 'worknote','pub'];
 
    public function getTimes($data) //App\Traits\CalendaritemBaseFunc
    {
        return $this->geItems($data, ['timetype', 'worker']);
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
