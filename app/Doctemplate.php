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
    protected $fillable = ['ceg_id', 'cat', 'name', 'filename', 'path',  'note', 'pub'];

    /**
     * adminnnak cégenként getWorkerDocs
     */
    public function getTemplates()
    {
        //$ceg = \Auth::user()->getCeg();
        $res = Doctemplate::get();
        return $res;
    }

    public function cleanchars($string)
    {
        $chars = array(
            "á" => "a", "é" => "e", "í" => "i",
            "ü" => "u", "ű" => "u", "ú" => "u",
            "ő" => "o", "ö" => "o", "ó" => "o",
            "Á" => "A", "É" => "E", "Í" => "I",
            "Ü" => "U", "Ű" => "U", "Ú" => "U",
            "Ő" => "O", "Ö" => "O", "Ó" => "O",
        );
        $a = str_replace(array_keys($chars), $chars, $string);
        $b = preg_replace("/[^a-zA-Z0-9]+/", " ", $a); //leceréli szóközre ami nem szám vagy betű
        $c = trim($b); //elejéről végéről eltávolítja a szóközöket.
        return preg_replace('/\s+/', '_', $c); //szóközöket aláhüzásra cseráli több egymás mellettit egyre
    }
    public function pdfView($html){
        $dompdf = new Dompdf\Dompdf();
     //   $data['worker'] = $worker;
      //  $html = view('doc_tmpl.'.$tmpl, compact('data'))->render();
        $dompdf->load_html($html,'UTF-8');
        $dompdf->render();
        $output = $dompdf->output();
       // file_put_contents($path . $rdat['filename'], $output);
        $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
 
    }

/**
 * nem kell jogosultság vizsgálat mert csak a manager configból érhető el
 */
    public function storeDoc($data,$act)
    {
        //TODO: megoldani a hibajelet ha nem jön létre a file vagy a rekord
        // $path='/chanel number5 /';'ceg_id',  'worker_id', 'origin', 'name', 'filename', 'path',  'worknote','worknote', 'pub'
        $cegid = \Auth::user()->getCeg()->id;
       // $path = storage_path('app/public').'/' . $cegid.'/';
        $path = 'app/public/' . $cegid.'/';
        $tmpl=$act['viewpar']['doc_tmpl'];
        $workeids=$data['workerids'] ?? [];
        foreach ($workeids as $workerid) {
            $worker = Worker::where('id', $workerid)->first();
            if ($cegid == $worker->ceg_id) {

                $filename =  $worker->workername . '_'.$tmpl.'_' . Carbon::now();
                $safename =$this->cleanchars($filename);
                $rdat['ceg_id'] = $worker->ceg_id;
                $rdat['worker_id'] = $worker->id;
                $rdat['origin'] = $safename  . '.pdf';
                $rdat['name'] = $filename;
                $rdat['cat'] = $tmpl;
               // $rdat['filename'] = $safename . '_' . mktime() . '.pdf';
                $rdat['filename'] = $safename . '.pdf';
                $rdat['path'] = $path;
                $data['worker'] = $worker;
               $html = view('doc_tmpl.'.$tmpl, compact('data'))->render();
             //   $html=iconv(mb_detect_encoding($html, mb_detect_order(), true), "UTF-8", $html);
                $this->pdfGen($rdat,$html);
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

}
