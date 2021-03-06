<?php

namespace App\Traits;

trait MoPdf 
{
public $tmplPath='tmpl';      
public $head='<!DOCTYPE html> <html><head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><title>Page Title</title><style> *{font-family: DejaVu Sans !important;} </style></head><body>';  
public $footer='</body></html>';  
public $editPre='&lt;&lt;['; 
public $editAfter=']&gt;&gt;'; 
public $htmlPre='{{$data['; 
public $htmlAfter=']}}';


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
        public function editortexToBlade($editortext='')
        {   
            $editortext= str_replace($this->editPre,$this->htmlPre,$editortext);
            return $editortext= str_replace($this->$editAfter,$this->htmlAfter,$editortext); 

        }
        public function bladeToEditortex($blade='')
        {   
            $blade= str_replace($this->htmlPre,$this->editPre,$blade);
            return str_replace($this->htmlAfter,$this->$editAfter,$blade); 
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
        public function pdfStore($filename,$html,$pdfpath=null){
            $dompdf = new Dompdf\Dompdf();
            $path=storage_path($pdfpath ?? $this->$pdfPath);
             if(!is_dir($path)){mkdir($path,755);}
            $dompdf->load_html($html,'UTF-8');
            $dompdf->render();
            $output = $dompdf->output();
            file_put_contents($path.$filename, $output);            
        }
        public function bladeStore($filename,$html,$bladepath=null){
            $path=storage_path($pdfpath ?? $this->$pdfPath);

            $dompdf = new Dompdf\Dompdf();
            $path=storage_path($this->$tmplPath);
             if(!is_dir($path)){mkdir($path,755);}
            $dompdf->load_html($html,'UTF-8');
            $dompdf->render();
            $output = $dompdf->output();
            file_put_contents($path.$filename, $output);            
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