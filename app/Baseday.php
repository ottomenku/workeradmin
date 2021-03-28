<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
class Baseday extends BaseModel
{
   // use LogsActivity;
  //  use SoftDeletes; 
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'basedays';

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
    protected $fillable = ['workday','name', 'datum', 'note', 'pub'];

    public function moIndex()
    {
        return   $this->with("daytype")->get();
    }


public function getBaseDays($year=0,$month=0)
{
    $res=[];
    if(empty($year)){$year= Carbon::now()->year;}
    if(empty($month)) {$month= Carbon::now()->month;}
    if(strlen($month)<2){$month='0'.$month;}

    $days= $this->with('daytype')->where([
        ['datum', 'like', $year.'-'.$month.'%']
    ])->get();
    foreach($days as $day){
        $res[$this->datumTwoChar($day->datum)]=$day->toarray();
    }
return $res;  
}
public function twoChar($num)
{
    if(strlen($num)<2){
        $num='0'.$num;
    }
  return  $num; 
}
public function datumTwoChar($datum,$sep='-')
{
$datumT= explode($sep,$datum);
$datumT[1]=$this->twoChar($datumT[1]);
$datumT[2]=$this->twoChar($datumT[2]);
  return  implode($sep,$datumT); 
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
