<?php
namespace App\Handlers;
use App\worker;

class FileHandler
{

    public $tmplPath='doc_tmpl'; // könyvtár tehát az alkönyvtárhoz DIRECTORY_SEPARATOR -t használjunk 
    public $pdfPath='doc'; //  könyvtár tehát az alkönyvtárhoz DIRECTORY_SEPARATOR -t használjunk  
    public $head='<!DOCTYPE html> <html><head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><title>Page Title</title><style> *{font-family: DejaVu Sans !important;} </style></head><body>';  
    public $footer='</body></html>';  
    public $editPre='&lt;&lt;['; 
    public $editAfter=']&gt;&gt;'; 
    public $htmlPre='{{$data['; 
    public $htmlAfter=']}}';

    public function getProperty($name)
    {   
     return $this->$name;
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

    public function getSafeName($name,$unique=true)
    {   
        $res=$this->cleanchars($name);
        if($unique){ return uniqid($res.'_');   }else{ return $res;}
    }
    /**
     *get Doc template dir  full path: c://public/...... ha csak a viewn bewluli dir kell: getProperty('tmplPath')
     */
    public function getDoctmplDirFulllPath($bladepath=null){;
        $blpath=$bladepath ?? $this->tmplPath;
        return resource_path('views'.DIRECTORY_SEPARATOR.$blpath);          
    }
    /**
     * \FileHandler::getDoctmplBladeFilePath($item->filename,'') // ha nemakarunk kiterjesztést amásrodik paraméter legyen üres
     * meg lehet adni más view könyvtárat is harmadik paraméterként
     */
    public function getDoctmplBladeFileFullPath($filename,$ext='.blade.php',$bladepath=null){
        $path =  $this->getDoctmplDirFulllPath($bladepath);
        return $path.DIRECTORY_SEPARATOR .$filename.$ext;           
    }
    /**
     * a view elérési utja  aview könyvtáron belül ha nem kell a kiterjesztés a második para legyen ures
     */
    public function getDoctmplBladePath($filename,$ext='.blade.php',$bladepath=null){
        $path =  $bladepath ?? $this->$this->tmplPath;
        return $path.DIRECTORY_SEPARATOR .$filename.$ext;           
    }
    /**
     * pontokkal elválasztott balde elérés '.blade.php' nelkül
     */
    public function getDoctmplView($filename,$tmplView=null){
        $path =  $tmplView ?? $this->$tmplPath;
        $path = str_replace(DIRECTORY_SEPARATOR,'.',$path);
        return $path.'.'.$filename;           
    }
    public function editortexToBlade($editortext='')
    {   
       return $editortext= str_replace($this->editPre,$this->htmlPre,$editortext);
       // return $editortext= str_replace($this->editAfter,$this->htmlAfter,$editortext); 

    }
    /**
     * nem használt
     */
    public function editortexToBladeWithData($data=[],$editortext='')
    {   
       // $editortext= '<script> var data=' </script>';
        $editortext.= '@php $datastring='.json_encode($data).'; $data=json_decode($datastring); @endphp';
        $editortext.= str_replace($this->editPre,$this->htmlPre,$editortext);

        return $editortext;

    }
    public function bladeToEditortex($blade='')
    {   
        $blade= str_replace($this->htmlPre,$this->editPre,$blade);
        return str_replace($this->htmlAfter,$this->editAfter,$blade); 
    }
    public function contentToFullhtml($content='')
    {    
        return $this->head.$content.$this->footer;
    }
    public function fullhtmlToContent($html='')
    {    
        $blade= str_replace($this->head,'',$html);
        return str_replace($this->footer,'',$html);
    }
     /**
     *filenévnek nem kell nem kell kiterjesztés
     * 
     */
    public function pdfStore($filename,$html,$pdfpath=null){
        $html=   \View::make('doc_tmpl.frame')
        ->with('data', $this->DATA)
        ->with('viewpar', $this->ACT['viewpar'])
        ->render();
         $dompdf = new Dompdf\Dompdf();
       $dompdf->load_html($html,'UTF-8');
        $dompdf->render();
        $output = $dompdf->output();
        file_put_contents($path.$filename, $output);            
    }
    /**
     *filenévnek nem kell nem kell kiterjesztés
     */
    public function bladeStore($filename,$html,$bladepath=null){;
         $path=$this->getDoctmplDirFulllPath($bladepath);
        $filepath =$this->getDoctmplBladeFileFullPath($filename);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        file_put_contents($filepath, trim($html));           
    }
/**
 * Render a given blade template with the optionally given data
 */
function blade($template, $data = []): string
{
$filename = uniqid('blade_');

$path = storage_path('tmp');

\View::addLocation($path);

$filepath = $path . DIRECTORY_SEPARATOR . "$filename.blade.php";

if (!file_exists($path)) {
    mkdir($path, 0777, true);
}
file_put_contents($filepath, trim($template));

$rendered = (\View::make($filename, $data))->render();

unlink($filepath);

return $rendered;
}

}