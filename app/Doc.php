<?php

namespace App;

use App\Worker;
//use App\Handlers;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Handlers\FileHandler;
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
    protected $basePath = 'doc';  // nem lehet sima path mert akkor a $doc->path  (eloquentes objektum) ez lesz
    protected $cegPath = '';   //$this->path.DIRECTORY_SEPARATOR.$ceg->id;
    protected $fullpath = '';  //storage_path().DIRECTORY_SEPARATOR. $this->cegPath ;
    protected $resize = true;
    protected $width = 1000;    //max width megtarja az arányokat
    protected $height = 1000;    //max height megtarja az arányokat
    protected $user; 
    protected $ceg; 
    protected $fleInputName='filef'; 
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
    protected $fillable = ['ceg_id', 'worker_id','cat', 'origin', 'name', 'filename', 'type','path','editodataa','data','worknote', 'adnote', 'pub'];

   //TODO type-ot meg ownwer_id -ot beírni a migrationba
   
//--- manager function -----------------------------
    public function getManagerAdatkezeles()
    {
        $ceg = \Auth::user()->getCeg();
        $res = Doc::where(['ceg_id' => $ceg->id])->with('worker')->get();
        return $res;
    }

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
                $data['worknote'] = $data['note'] ?? '' ;
                $data['filename'] = \FileHandler::pdfStore($pdfdata,$act['viewpar'],$data['name'] );
                $data['data']=json_encode($pdfdata);
                $this->create($data);
            }
        }
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

//---  worker function ---------------------------------
    public function getWorkerDocs()
    {
        $workerid = \Auth::user()->getWorkerid();
        $res = Doc::where(['worker_id' => $workerid])->with('worker')->get();
        return $res;
    }
    public function storeWorkerDoc($request,$data)
    { 
        $this->setUserAndceg();
        $file = $this->setDirAndFile($request);
        $data=$this->getdataToStoreDoc( $file,$data); 
        
      if(in_array($data['type'],['jpeg','png','jpg',])){//ha kép jön (a type-ot a getdatatoStoreDoc() kisbetűsre alakítja)
            $this->saveImage($file,$data,$this->resize);
           
        }else{//nem kell elseif mert a validation ellenőrzi hogy csak kép vagy dok jöhessen
            $file->move( $this->fullpath, $data['filename']);
        }      
       $this->create($data);
    }
/**
 * csak akkor törli ha a sajátja és nem régi 
 */
public function destroyWorkerOne($id) //
{
    $item= $this->find($id);
    $to = Carbon::createFromFormat('Y-m-d H:s:i', $item->updated_at);
    $from =Carbon::now();
    $diff_in_hours = $to->diffInHours($from);
    $user=\Auth::user();
    if($diff_in_hours<3 && $item->worker_id==$user->getWorkerid()) {
    $path=storage_path().DIRECTORY_SEPARATOR.$item->path; 
    $filename=$item->filename;
    unlink($path.DIRECTORY_SEPARATOR.$filename);
    $this->destroy($id);
    }
   // if ($stored['lezarva'] == false) {} //lehet tömb is
   return  $item;
}

public function proba() //
{
    $item= $this->find(2);
    $to = Carbon::createFromFormat('Y-m-d H:s:i', $item->updated_at);
    $from =Carbon::now();
    $diff_in_hours = $to->diffInHours($from);
    //print_r($diff_in_hours);// Output: 6
return $diff_in_hours;
}
/**
 *    $file['type'] = $request->file('file')->getMimeType(); nem kell jogosultság vizsgálat mert csak a manager configból érhető el
 */
 
// --- handlerek------------------------------------------------------------------------

    public function getdataToStoreDoc($file,$data)
    {         
        $filehandler= new FileHandler();
        
        $workerid=$this->user->getWorkerid();
        $fileNameWithoutExt=pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $name=$data['name'] ??  $fileNameWithoutExt;
        $data['type']=strtolower($file->getClientOriginalExtension());
        $data['name'] = $name;
        $data['origin'] =$file->getClientOriginalName();
       // $data['mimetype'] =$file->getMimeType();  
        $data['worker_id'] =$workerid;
        $data['owner_id'] =$workerid;
        $data['ceg_id'] =$this->ceg->id;
        $data['cat'] = 'workerdoc';
        $data['workernote'] = $data['note'] ?? '' ;     
        $data['filename'] = $filehandler->getSafeName($name,true).'.'.$data['type'];
        $data['path'] =$this->cegPath;
     return $data;   
    }
   public function saveImage($file,$data, $resize=true)
    {   
        $img = \Image::make($file);
        if($resize){
        $width = $this->width; // your max width
        $height =$this->height; // your max height     
        $img->height() > $img->width() ? $width=null : $height=null;

        $img->resize($width, $height, function ($constraint) {
        $constraint->aspectRatio();
        });
        $img->encode($data['type'])->save($this->fullpath.DIRECTORY_SEPARATOR. $data['filename'] );
        }
    }



    public function setUserAndceg()
    {    
        $this->user=\Auth::user();
        $this->ceg =$this->user->getCeg();
    }

    public function setDirAndFile($request)
    {   
        $this->cegPath = $this->basePath.DIRECTORY_SEPARATOR.$this->ceg->id;
        $this->fullpath=storage_path().DIRECTORY_SEPARATOR. $this->cegPath;
        if(!is_dir($this->fullpath))
        {
            if (!mkdir($this->fullpath, 0777, true)) {die('Failed to create folders...'); }
        } 
        return $request->file($this->fleInputName);  //$file
    }
 
/**
 * ha le van zárva nem törli
 */
    public function destroyManagerOne($id) //
    {
        $filename= $this->find($id)->filename;
        $path=\FileHandler::getCegDocPdfPath();
        unlink($path.DIRECTORY_SEPARATOR.$filename);
        $this->destroy($id);
       // if ($stored['lezarva'] == false) {} //lehet tömb is

    }
 /**
  * Csak adminoknak mocontroller ellenőrzi a jogot
   */   
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
   

 /*   public function show($id)
    {
        return $this->findOrfalse($id);

    }*/
    public function download($id)
    {
        $item= $this->find($id);
        $filePath = $item->path.DIRECTORY_SEPARATOR.$item->filename;
      //  $headers = ['Content-Type: application/pdf'];
       // $fileName = time().'.pdf';
     //    return response()->download(storage_path($filePath));
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
