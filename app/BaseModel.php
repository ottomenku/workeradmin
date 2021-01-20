<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// TODO megoldani hogy lehessen minusz a pub mező
class BaseModel extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     * 
     */

    public function getSelectList()
    { 
      return $this->where('pub','>',0)->pluck('name', 'id');
    }

    public function allPluck()
    { 
        return $this->all()->pluck('name', 'id');
    }

    public function moIndex()
    {
        return   $this->all();
    }

    public function moEdit($id)
    {
      return $this->findOrFail($id);  
    }
    public function moCreate($data)
    {

      $this->create($data);

    }
    public function moUpdate($id,$data)
    {
      $ob= $this->findOrFail($id);  
      $ob->update($data);

    }
    public function moDestroy($id)
    {
        $this->destroy($id);
    }

    public function show($id)
    {
      return $this->findOrFail($id);      
    }
    
    public function pub($id)
    {
        $ob=$this->find($id);
        $ob->update(['pub'=>1]);
    }
    public function unpub($id)
    {
        $ob= $this->find($id);
        $ob->update(['pub'=>-1]);
    }

}
