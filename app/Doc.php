<?php

namespace App;

use App\Worker;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dompdf;
class Doc extends Model
{
    //use LogsActivity;
    use  \App\Traits\MoPdf ;
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
    protected $fillable = ['ceg_id', 'worker_id','cat', 'origin', 'name', 'filename', 'path','editordata','data','worknote', 'adnote', 'pub'];

    public function proba($tmplid)
    {
        $data=['user'=>'username'];
       return  $this->blade("ggg {{$data['user']}}", $data);

      // return  view("ggg {{$data['user']}}", compact('data'))->render(); 
     //  return view (['template' => '{{$token}}'], ['token' => 'I am the token value']);
    }

   /**
     * adminnnak cégenként getWorkerDocs
     */
    public function getManagerAdatkezeles($doc_tmpl)
    {
        $ceg = \Auth::user()->getCeg();
        $res = Doc::where(['ceg_id' => $ceg->id, 'cat' => $doc_tmpl])->with('worker')->get();
        return $res;
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
       $cegid = \Auth::user()->getCeg()->id;
        $workeids=$data['workerids'] ?? [];
        foreach ($workeids as $workerid) {
            $worker = Worker::where('id', $workerid)->first();
            if ($cegid == $worker->ceg_id) {
                $rdat['ceg_id'] = $worker->ceg_id;
                $rdat['worker_id'] = $worker->id;
                $rdat['name'] = $rdat['name'];
               
                $rdat['cat'] = 'base';
               // $rdat['filename'] = $safename . '_' . mktime() . '.pdf';
               // $rdat['filename'] = $safename . '.pdf';
               // $rdat['path'] = $path;
               // $data['worker'] = $worker;
              // $html = view('doc_tmpl.'.$tmpl, compact('data'))->render();
             //   $html=iconv(mb_detect_encoding($html, mb_detect_order(), true), "UTF-8", $html);
             //   $this->pdfGen($rdat,$html);
                 $this->create($rdat);
           
            }

        }
    }
/**
 * ha le van zárva nem törli
 */
    public function destroyOne($id) //
    {
        $item = $this->findOrFail($id);
        unlink(storage_path($item->path.$item->filename));
        $this->destroy($id);
       // if ($stored['lezarva'] == false) {} //lehet tömb is

    }
    public function zarStored($data)
    {
        $stored = $this->find($data['id']);
        $stored->update(['lezarva' => true]);
        // return $this->getStoreds($data);

    }
    public function nyitStored($data)
    {
        $stored = $this->find($data['id']);
        $stored->update(['lezarva' => false]);
    }

   

    public function show($id)
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

    }

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
