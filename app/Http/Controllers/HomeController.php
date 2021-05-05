<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Stored;

class HomeController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function error($error)
    {
        return view('error',$error);
    }
    public function pdf($id)
    {
        $storedob=new Stored();      
        //$stored=$storedob->showAdminList(2020,01);
       $stored =$storedob->find($id)->toarray();
        $data['workerid']= $stored['worker_id'] ;
        $data['fulldata'] =json_decode($stored['fulldata'], true);
        $data['solver'] =json_decode($stored['solverdata'], true);
  // $data2=$data->toarray();

      //   var_dump($data);
      //  return view('pdfVue',$data);
      // return view('pdf')->with('data', $data);
      //view('users.edit', compact('user'))->render();
     $html = view('pdfcell',compact('data'))->render();
       $pdf = \App::make('dompdf.wrapper');
       $pdf->loadHTML($html);
        return $pdf->stream();
///  
 // $pdf = PDF::loadView('pdfCell',compact('data')) ;
  //   return $pdf->stream();
     
  //return view('pdfCell',compact('data'));
  
    }


}
