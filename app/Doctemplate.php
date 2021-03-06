<?php

namespace App;

use App\Worker;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dompdf;
class Doctemplate extends Model
{
    //use LogsActivity;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'doctemplates';

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
    protected $fillable = ['ceg_id', 'cat', 'name', 'filename', 'path', 'editordata', 'note', 'pub'];

    public function getTemplate($id)
    {
        return $this->findOrFail($id);; 
    }
    public function getTemplates()
    {
        return $this->get(); 
    }
    public function getMenu()
    {
        $dc = $this->select('id','cat','name')->get(); 
        foreach ($dc as  $dtmpl) {
            $res[$dtmpl['cat']][]=$dtmpl;
        }
        return $res ?? []; 
    }
  
    public function moUpdate($data)
    {  
        $item = $this->findOrFail($data['id']);
        $blade=\FileHandler::editortexToBlade($data['editordata'] ?? '');
       // $blade=\FileHandler::contentToFullhtml($content);
        unlink(\FileHandler::getDoctmplBladeFileFullPath($item->filename,''));
        \FileHandler::bladeStore($item->filename,$blade);
        $item->update($data);
    }
/**
 * nem kell jogosultság vizsgálat mert csak a manager configból érhető el
 */
    public function tmplstore($data)
    {
        
       $blade=\FileHandler::editortexToBlade($data['editordata'] ?? '');
      //  \FileHandler::contentToFullhtml($content);
        $filename=\FileHandler::getSafeName($data['name'],$unique=false);
        \FileHandler::bladeStore($filename,$blade);
        $data['filename']=$filename;
        $data['path']=\FileHandler::getProperty('tmplPath');
        $this->create($data);
    }
/**
 * ha le van zárva nem törli
 */
    public function destroyOne($id) //
    {
        $this->destroy($id);

    }

      public function moEdit($id)
    {
        $data=$this->find($id)->toarray();
        return $data;
    }
    public function pub($id)
    {
        $ob=$this->find($id);
        $ob->update(['pub'=>1]);
    }
    public function unpub($id)
    {
        $ob= $this->find($id);
        $ob->update(['pub'=>0]);
    }

    public function show($id)
    {
        return $this->findOrfalse($id);

    }

    public function ceg()
    {
        return $this->belongsTo('App\Ceg');
    }

}
