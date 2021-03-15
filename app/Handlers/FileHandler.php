<?php
namespace App\Handlers;
use App\worker;

class FileHandler
{
//TODO: configból feltöten a paramétereket.
// sem file neveknél sem pathoknál elejére végére nem teszünk DIRECTORY_SEPARATOR-t összefűzésnél szúrjuk be
    public $tmplPath='doc_tmpl'; // a resources/view-en belüli könyvtár Az alkönyvtárhoz DIRECTORY_SEPARATOR -t használjunk 
    public $pdfPath='doc'; // a storage-on belüli könyvtár Az alkönyvtárhoz DIRECTORY_SEPARATOR -t használjunk  
    public $head='<!DOCTYPE html> <html><head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><title>Page Title</title><style> *{font-family: DejaVu Sans !important;} </style></head><body>';  
    public $footer='</body></html>';  
    public $editPre='&lt;&lt;['; 
    public $editAfter=']&gt;&gt;'; 
    public $htmlPre='{{$data['; 
    public $htmlAfter="] ?? '' }}";

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
    public function getDoctmplDirPath($bladepath=null,$full=true){
        $blpath=$bladepath ?? $this->tmplPath;
        if($full ){ return resource_path('views'.DIRECTORY_SEPARATOR.$blpath);} 
        else{ return 'views'.DIRECTORY_SEPARATOR.$blpath ;}      
    }
    public function getDocPdfPath($pdfpath=null,$full=true){;
        $blpath=$bladepath ?? $this->pdfPath;
        if($full){return storage_path($blpath);}
        else{return 'views'.DIRECTORY_SEPARATOR.$blpath;}        
    }
    public function getCegDocPdfPath($pdfpath=null,$full=true){
      return   $this->getDocPdfPath($pdfpath,$full).DIRECTORY_SEPARATOR.\Auth::user()->getCeg()->id ;
    }
    /**
     * \FileHandler::getDoctmplBladeFilePath($item->filename,'') // ha nemakarunk kiterjesztést amásrodik paraméter legyen üres
     * meg lehet adni más view könyvtárat is harmadik paraméterként
     */
    public function getDoctmplBladeFileFullPath($filename,$ext='.blade.php',$bladepath=null,$full=true){
        $path =  $this->getDoctmplDirPath($bladepath,$full);
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
       $editortext= str_replace($this->editPre,$this->htmlPre,$editortext);
        return $editortext= str_replace($this->editAfter,$this->htmlAfter,$editortext); 

    }
    /**
     * nem használt egyenlőre.......................
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
     * minden file-t vele kell elkészítetni
     * //TODO: meg kell oldani a hibakezelést
     */
public function saveFile($path,$filename,$content,$dirmake=true){
    if ($dirmake && !file_exists($path)) {
        mkdir($path, 0777, true);
    }
    file_put_contents($path.DIRECTORY_SEPARATOR.$filename, trim($content));
}
/**
 * return lehet output: fájlba írni, stream: meejeleníteni, obj, üres akkor doompdf objektummal tér vissza
 */
public function pdfGeneral($html,$return='output'){
    $dompdf = new \Dompdf\Dompdf();
    $dompdf->load_html($html,'UTF-8');
     $dompdf->render();
     if($return=='output'){ return $dompdf->output();}
     elseif($return=='output'){return  $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));}
     else{ return $dompdf;}  
}   
public function htmlfromView($view='doc_tmpl.frame',$data=[],$viewpar=[]){
  return \View::make($view)
    ->with('data', $data)
    ->with('viewpar', $viewpar)
    ->render();
} 
     /**
     * $name a dokumentum neve átkonvertálja filenévvé és eléteszi a workername-t
     * a doc  templatet doc_tmpl.frame aállapija meg az $viewpar['id']-ből vagy post esetén A DATA['id'] ből
     *  de $viewpar['include'] dal felül lehet írni
     */
    public function pdfStore($data,$viewpar,$name){
        $filename=$this->getSafeName($data['worker']['workername'].'_'.$name).'.pdf';
        $path=$this->getDocPdfPath().DIRECTORY_SEPARATOR.$data['ceg']['id'];
        $html=$this->htmlfromView('doc_tmpl.frame',$data,$viewpar);
        $content=$this->pdfGeneral($html,'output');
        $this->saveFile($path,$filename,$content);
        return $filename;         
    }
    /**
     *filenévnek nem kell nem kell kiterjesztés
     */
    public function bladeStore($filename,$html,$bladepath=null){;
        $path=$this->getDoctmplDirPath($bladepath);
        $this->saveFile($path,$filename.'.blade.php',$html,true);         
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