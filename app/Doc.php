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
    use SoftDeletes;
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
    protected $fillable = ['ceg_id', 'worker_id', 'origin', 'name', 'filename', 'path', 'worknote', 'worknote', 'pub'];

    /**
     * adminnnak cégenként
     */
    public function getManagerAdatkezeles()
    {
        $ceg = getCeg();
        $res = Ceg::where(['ceg_id' => $ceg->id, 'form' => 'adatkezeles']);
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
    public function pdfGen($rdat,$html){
         //TODO: karakterkódolást megoldani
       // $html = view('pdfcell', compact('data'))->render();

        // $pdf = \App::make('dompdf.wrapper');
        // $pdf->loadHTML($html);
        //  return $pdf->stream();

        $dompdf = new Dompdf\Dompdf();
      //  $dompdf->load_html($html);
      if(!is_dir($rdat['path'])){mkdir($rdat['path'],755);}
        $dompdf->load_html($html,'UTF-8');
       // $dompdf->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $dompdf->render();
        $output = $dompdf->output();
        file_put_contents($rdat['path'] . $rdat['filename'], $output);
        
    }
    public function htmlGen($userdat,$htmlname){
        $html=file_get_contents(storage_path('app/doc_tmpl').'.\\'.$htmlname.'.html', true);
            foreach($userdat as $key=>$dat){
                $html=  str_replace('$'.$key.'$',$dat,$html);
            }
            return $html;
       
   }
/**
 * nem kell jogosultság vizsgálat mert csak a manager configból érhető el
 */
    public function storeAdatkezeles($data)
    {
        //TODO: megoldani a hibajelet ha nem jön létre a file vagy a rekord
        // $path='/chanel number5 /';'ceg_id',  'worker_id', 'origin', 'name', 'filename', 'path',  'worknote','worknote', 'pub'
        $cegid = \Auth::user()->getCeg()->id;
        $path = storage_path('app/public').'/' . $cegid.'/';
        foreach ($data['workerids'] as $workerid) {
            $worker = Worker::where('id', $workerid)->first();
            if ($cegid == $worker->ceg_id) {

                $filename = $this->storeAdatkezeles($worker->name . '_' . $worker->user->username) . '_adatkezeles_' . Carbon::now();
                $safename = preg_replace("/[^a-zA-Z0-9]+/", " ", $worker->name);
                $rdat['ceg_id'] = $worker->ceg_id;
                $rdat['worker_id'] = $worker->id;
                $rdat['origin'] = $filename . '.pdf';
                $rdat['name'] = $filename;
                $rdat['filename'] = $filename . '_' . mktime() . '.pdf';
                $rdat['path'] = $path;
                $this->pdfGen($rdat);
                $this->create($rdat);
           
            }

        }
    }
/**
 * ha le van zárva nem törli
 */
    public function delStored($data) //

    {
        $stored = $this->findOrFail($data['id']);
        if ($stored['lezarva'] == false) {$this->destroy($data['id']);} //lehet tömb is

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

    public function getSolverData($fulldata)
    {
        $solver = [];
        $sumWorkerdays = 0;
        foreach ($fulldata['calendarbase'] as $key => $value) {
            if ($value['munkanap']) {$solver['workerdays'][] = $value['day'];
                $sumWorkerdays++;}
        }
        $solver['sumWorkerdays'] = $sumWorkerdays;
        foreach ($fulldata['times']['idkey'] as $key => $value) {
            if ($value['pub'] > 5) {
                $solver['times'][$value['timetype']['name']]['hours'][] = substr($value['datum'], -2) . '.(' . $value['hour'] . '), ';
                $solver['times'][$value['timetype']['name']]['sumhours'] = $solver['times'][$value['timetype']['name']]['sumhours'] ?? 0;
                $solver['times'][$value['timetype']['name']]['sumhours'] = $solver['times'][$value['timetype']['name']]['sumhours'] + $value['hour'];
            }
        }
        foreach ($fulldata['workerdays']['idkey'] as $key => $value) {
            if ($value['pub'] > 5) {
                $solver['days'][$value['daytype']['name']]['days'][] = substr($value['datum'], -2);
                $solver['days'][$value['daytype']['name']]['sumdays'] = $solver['days'][$value['daytype']['name']]['sumdays'] ?? 0;
                $solver['days'][$value['daytype']['name']]['sumdays'] = $solver['days'][$value['daytype']['name']]['sumdays'] + 1;
            }
        }

        return $solver;
    }

    public function show($id)
    {
        return $this->findOrfalse($id);
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
