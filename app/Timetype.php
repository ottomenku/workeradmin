<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timetype extends BaseModel
{
    /**
     * The database table used by the model.
     * 
     *
     * @var string
     */
    protected $table = 'timetypes';
    public $timestamps = false;
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
    protected $fillable = ['ceg_id','name', 'szorzo', 'fixplusz', 'color', 'note', 'pub'];


    public function timetypesPluck()
    {
      return $this->all()->pluck('pub','>',0);  
    }
    public function ceg()
	  {
		return $this->belongsTo('App\Ceg');
    }
    public function time()
    {
      return $this->hasMany('App\Time'); 
    }
}
