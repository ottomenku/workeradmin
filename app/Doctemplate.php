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
        return Doctemplate::get(); 
    }
    public function getMenu()
    {
        $dc = Doctemplate::select('id','cat','name')->get(); 
        foreach ($dc as  $dtmpl) {
            $res[$dtmpl['cat']][]=$dtmpl;
        }
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
    public function pdfView(){
      //  $html = $_POST['html'];
   dump($_POST);
     /*   $dompdf = new Dompdf\Dompdf();
     //   $data['worker'] = $worker;
      //  $html = view('doc_tmpl.'.$tmpl, compact('data'))->render();
        $dompdf->load_html($html,'UTF-8');
        $dompdf->render();
        $output = $dompdf->output();
       // file_put_contents($path . $data['filename'], $output);
        $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
 */
    }
/**
 * nem kell jogosultság vizsgálat mert csak a manager configból érhető el
 */
public function formeditsave($data)
{
    //TODO: megoldani a hibajelet ha nem jön létre a file vagy a rekord
  //  $cegid = \Auth::user()->getCeg()->id;
  $item = $this->findOrFail($data['id']);
  $item->update($data);
            $head='<!DOCTYPE html> <html><head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><title>Page Title</title><style> *{font-family: DejaVu Sans !important;} </style></head><body>';
            $footer='</body></html>';
            $editordata= $data['editordata'] ?? '';
            $editordata= str_replace('&lt;&lt;[','{{$data[',$editordata);
            $editordata= str_replace(']&gt;&gt;',']}}',$editordata); 
            $html= $head.$editordata.$footer;
            file_put_contents(resource_path().'/views//'. $item['path'].$item['filename'], $html);
          //  $myfile = fopen(resource_path().'/views//'. $item['path'].$item['filename'], "w") ;
          //  fwrite($myfile, $html);
          //  fclose($myfile);
}
/**
 * nem kell jogosultság vizsgálat mert csak a manager configból érhető el
 */
    public function formsave($data)
    {
        //TODO: megoldani a hibajelet ha nem jön létre a file vagy a rekord
        $cegid = \Auth::user()->getCeg()->id;
        $path = 'doc_tmpl/';  //resource_path('').'views/doc_tmpl/'

                $filename =  $data['name'].'_' . Carbon::now();
                $safename =$this->cleanchars($filename);
      
               // $data['filename'] = $safename . '_' . mktime() . '.pdf';
                $data['filename'] = $safename . '.blade.php';
                $data['path'] = $path;
                $head='<!DOCTYPE html> <html><head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><title>Page Title</title><style> *{font-family: DejaVu Sans !important;} </style></head><body>';
                $footer='</body></html>';
               // {{$data
                $editordata= $data['editordata'] ?? '';
                $editordata= str_replace('&lt;&lt;[','{{$data[',$editordata);
                $editordata= str_replace(']&gt;&gt;',']}}',$editordata); 
                $html= $head.$editordata.$footer;
                $myfile = fopen(resource_path().'/views//'. $data['path'].$data['filename'], "w") ;
                fwrite($myfile, $html);;
                fclose($myfile);
                $this->create($data);
    }
/**
 * ha le van zárva nem törli
 */
    public function destroyOne($id) //
    {
        $item = $this->findOrFail($id);
        unlink(resource_path().'/views/doc_tmpl//'.$item->filename);
        $this->destroy($id);
       // if ($stored['lezarva'] == false) {} //lehet tömb is

    }

      public function moEdit($id)
    {
        $data=$this->find($id)->toarray();
        $html=file_get_contents(resource_path().'/views//'. $data['path'].$data['filename'], true);
      
        $html= str_replace('<!DOCTYPE html> <html><head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><title>Page Title</title><style> *{font-family: DejaVu Sans !important;} </style></head><body>','',$html);
        $html= str_replace('</body></html>','',$html);
        $html= str_replace('{{$data[','&lt;&lt;[',$html);
        $html= str_replace(']}}',']&gt;&gt;',$html); 
        $data['html']=$html;
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
