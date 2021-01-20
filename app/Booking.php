<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Mail;

class Booking extends Model
{
   // use LogsActivity;
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bookings';
    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $cegid = null;  // kell hogy az alqueryben elérhető legyen

    /**
     * Attributes that should be mass-assignable.
     *          $table->integer('worker_id')->unsigned();
     * @var array
     */
    protected $fillable = ['daytype_id', 'worker_id', 'start', 'end', 'adnote', 'worknote', 'pub', 'open'];
 

    public function unpub($id) //index-----------------
    {
        $booking=$this->find($id);
        $booking->update(['pub'=>-1]);
    }
    public function pub($id) //index-----------------
    {
        $booking=$this->find($id);
        $booking->update(['pub'=>1]);
      //  die($id);
    }
    public function basepub($id) //index-----------------
    {
        $booking=$this->find($id);
        $booking->update(['pub'=>0]);
      //  die($id);
    }
    public function download($id) //index-----------------
    {
        $file=File::with('booking')->find($id);
        return $file->path.$file->filename;
  
    }
    public function getlist() //index-----------------
    {
        // Get the currently authenticated user...
        $worker_id=Auth::user()->getWorkerid();
        $data=$this->where('worker_id',$worker_id)->with('filelist','worker')->get();
        return $data;  
    }
      public function getAdminlist() //index-----------------
    { 
        $this->cegid=Auth::user()->getCegid();

     /*   return $this->leftJoin('workers','workers.id', '=', 'worker_id')
        ->where('workers.ceg_id', '=', $this->cegid)
        ->get(); */

        // Get the currently authenticated user...
      
     $res = $this->with(['worker' => function ($query) {
        $query->where('ceg_id', '=', $this->cegid);
    }])->get();
        //$data=$this->where('worker_id',$worker_id)->with('filelist','worker')->get();

      return   $res;
         
    }
    public function moEdit($id)
    {
        $data=$this->where('id',$id)->with('filelist','worker')->first(); 
        return $data;   
    }
    public function moUpdate($id,$data) //az eredeti updatenek kell a request
    {  
        $booking= $this->find($id);  
        if(isset($data['file']) && !empty($data['file'])){
            $fileob_id=$this->storeFile($data['file']);
            $booking->filelist()->attach($fileob_id); 
        }  
        $booking->update($data);
    }
    public function email($data)
    { 
        $user = Auth::user();

        Mail::raw('</h3>Hi, welcome user!</h3>', function ($message) {
            $message->to('proba@berszamfejto.com')
              ->subject('Értesítés');
          });

    }
    public function store($data)
    {    
        $data['worker_id']=Auth::user()->getWorkerid();   
        $booking= $this->create($data);
        if(isset($data['file'])){
            $fileob_id=$this->storeFile($data['file']);
            $booking->filelist()->attach($fileob_id); 
        }
        
    }
    public function storeFile($file)
    {
        $worker_id=Auth::user()->getWorkerid();
        $filedata=[
        'filename'=>'temp_'.time().'.'.$file->getClientOriginalExtension(),
        'name'=>$file->getClientOriginalName(),
        'origin'=>$file->getClientOriginalName(),
        'path'=>Auth::user()->getCeg()->id.'/',
        ];
        $fileob= File::create( $filedata);
        $fileob_id=$fileob->id;
        $filename=$worker_id.'_'.$fileob_id.'_'.time().'.'.$file->getClientOriginalExtension();
        $fileob->update(['filename'=>$filename]);
        $file->storeAs($filedata['path'], $filename);
        return  $fileob->id;
    }

    public function delAdmin($id)
    {
        $adminceg=Auth::user()->getCeg();
        $booking= Booking::with('filelist')->find($id);
        $workerid=$booking->worker_id;
        $workerceg=User::getCeg($workerid);
        if($adminceg==$workerceg){
            foreach ($booking->filelist as $file) {
                $booking->filelist()->detach($file->id);
                Storage::delete($file->path.$file->filename);
            }       
            $booking->delete();
        }

    }
    public function delWorker($id)
    {
        $worker_id=Auth::user()->getWorkerid();
        $booking= Booking::with('filelist')->find($id);
        if($worker_id==$booking->worker_id){
            foreach ($booking->filelist as $file) {
                $booking->filelist()->detach($file->id);
                Storage::delete($file->path.$file->filename);
            }       
            $booking->delete();
        }
    
    }
    public function delFileWorker($id)
    {
        $worker_id=Auth::user()->getWorkerid();
       $file=File::with('booking')->find($id);
        if($worker_id==$file->booking[0]->worker_id)
        { 
            foreach ($file->booking as $booking) {
               $file->booking()->detach($booking->id);
            }          
            Storage::delete($file->path.$file->filename);
            $file->delete();
        }

    }

    public function filelist()
    {
        return $this->belongsToMany('App\File', 'booking_file');
    }
    public function daytype()
    {
        return $this->belongsTo('App\Daytype');
    }
    public function worker()
    {
        return $this->belongsTo('App\Worker');
    }
}
