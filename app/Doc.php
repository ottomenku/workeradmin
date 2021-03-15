<?php

namespace App;

use App\Worker;
//use App\Handlers;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dompdf;
class Doc extends Model
{
    //use LogsActivity;
 //   use  \App\Traits\MoPdf ;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'docs';

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
    protected $fillable = ['ceg_id', 'worker_id','cat', 'origin', 'name', 'filename', 'path','editodataa','data','worknote', 'adnote', 'pub'];

    public function proba($tmplid)
    {
        $data=['user'=>'username'];
       return  $this->blade("ggg {{$data['user']}}", $data);

      // return  view("ggg {{$data['user']}}", compact('data'))->render(); 
     //  return view (['template' => '{{$token}}'], ['token' => 'I am the token value']);
    }
    public function getManagerAdatkezeles()
    {
        $ceg = \Auth::user()->getCeg();
        $res = Doc::where(['ceg_id' => $ceg->id])->with('worker')->get();
        return $res;
    }
    public function getPdfPathFromId($id)
    {
        $filename= $this->find($id)->filename;
        $path=\FileHandler::getCegDocPdfPath();
        return $path.DIRECTORY_SEPARATOR.$filename;

    }
    public function moCreate($tmplid)
    {
        return  Doctemplate::find($tmplid);   
    }
/**
 * nem kell jogosultság vizsgálat mert csak a manager configból érhető el
 */
    public function storeDocs($data=[],$act=[])
    {
        $ceg = \Auth::user()->getCeg();
        $pdfdata=[];
        $pdfdata['ceg']=$ceg->toarray();   
        $workeids=$data['workerids'] ?? [];
        foreach ($workeids as $workerid) {
            $worker = Worker::where('id', $workerid)->with('user')->first();
            $pdfdata['worker']=$worker->toarray();
            if ($ceg['id'] == $worker['ceg_id']){
                $data['ceg_id'] = $worker['ceg_id'];
                $data['worker_id'] =$workerid;
                $data['cat'] = $data['cat'] ?? 'base';
                $data['workernote'] = $data['note'] ?? '' ;
                $data['filename'] = \FileHandler::pdfStore($pdfdata,$act['viewpar'],$data['name'] );
                $data['data']=json_encode($pdfdata);
                $this->create($data);
            }
        }
    }
/**
 * ha le van zárva nem törli
 */
    public function destroyOne($id) //
    {
        $filename= $this->find($id)->filename;
        $path=\FileHandler::getCegDocPdfPath();
        unlink($path.DIRECTORY_SEPARATOR.$filename);
        $this->destroy($id);
       // if ($stored['lezarva'] == false) {} //lehet tömb is

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
   

 /*   public function show($id)
    {
        return $this->findOrfalse($id);

    }
    public function download($id)
    {
        $item= $this->find($id);
        $filePath = $item->path.$item->filename;
      //  $headers = ['Content-Type: application/pdf'];
       // $fileName = time().'.pdf';
      //  return response()->download(storage_path("app/public/10/{$item->filename}"));
      return $filePath;

    }*/

    public function ceg()
    {
        return $this->belongsTo('App\Ceg');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function worker()
    {
        return $this->belongsTo('App\Worker');
    }
}
