<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
 //TODO törlésnél ha nem engedi törölni mert a tipus használatban van, ne hibajelet írjon ki pl. id=14  stgh...
class Daytype extends BaseModel
{  
   
    //use SoftDeletes;
    // protected $dates = ['deleted_at'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'daytypes';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    public $timestamps = false;
    /**
     * Attributes that should be mass-assignable. 
     *
     * @var array
     */
    protected $fillable = ['ceg_id','timetype_id', 'name', 'workday', 'szorzo', 'fixplusz', 'color','background','icon','note','userallowed','pub'];
    public function getCegDaytypes()
    {
        return $this->where(['ceg_id' => 1])->where('userallowed' ,'<', 100)->get();
    }
    public function getDaytype($id)
    {
        return $this->find( $id);
    }
    public function workerDaytypesPluck()
    {
        return $this->where([['userallowed',1]],['pub','>',0])->pluck('name', 'id');
    }
    public function baseDaytypesPluck()
    {
        return $this->where([['userallowed',100]],['pub','>',0])->pluck('name', 'id');
    }
    public function DaytypesPluck()
    {
        return $this->where('pub','>',0)->pluck('name', 'id');
    }
    public function ceg()
    {
        return $this->belongsTo('App\Ceg'); // assuming user_id and task_id as fk
    }
    public function timetype()
    {
        return $this->belongsTo('App\Timetype'); // assuming user_id and task_id as fk
    }
    public function day()
    {
        return $this->hasMany('App\Day');
    }
}
