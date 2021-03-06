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
    protected $fillable = ['ceg_id', 'name', 'szorzo', 'fixplusz', 'basehour', 'start', 'end', 'color', 'note', 'pub'];
    public function getAllWithCeg()
    {
        return   $this->with('ceg')->get();
    }
   
    public function getCegTimeTypes()
    {
        $ceg = \Auth::user()->getCeg();
        $res=[];
        $timetypes = $this->where('ceg_id','=',1)->orwhere('ceg_id','=', $ceg->id)->get()->toarray();
       foreach ($timetypes as $timetype) {
            $res[$timetype['id']] = $timetype;
        }
        return $res;
    }

    public function timetypesPluck()
    {
        return $this->all()->pluck('name', 'id');
    }
    public function ceg()
    {
        return $this->belongsTo('App\Ceg');
    }
    public function dytype()
    {
        return $this->hasMany('App\Daytype');
    }
    public function time()
    {
        return $this->hasMany('App\Time');
    }
}
