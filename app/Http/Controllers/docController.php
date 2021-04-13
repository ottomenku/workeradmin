<?php
namespace App\Http\Controllers\Admin;

use App\Category;
use App\Doc;
use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;

class DocController extends Controller
{ 
  use \App\Traits\StatPropertyHandler; //getProp('doc_path')
    
    private  $configFile = 'app'; // a config file neve ami felül írja az alap propertiket ha a getProp()-al kérjük le. ha felül akarjuk írni  a kulsnak meg kell egyeznie a property nevével
  //config file  felülírja--------------
    public  $doc_path;     //= 'resources/doc/'; //a dokumentumok mentésének helye 
    public  $docprev_path;  //= 'public/docprev/'; //prev fileok helye  
     public  $docprev_thumb_path;     //='public/docprev/thumb/';
    public  $base_prev_img ;//= ['pdf.png','file.png','doc.png']; // ezeket nem törli a prev img közül


public function __construct()
{
    $this->doc_path = config($this->configFile . '.doc_path') ?? $this->doc_path ;
    $this->docprev_path = config($this->configFile . '.docprev_path') ?? $this->docprev_path ;
     $this->docprev_thumb_path = config($this->configFile . '.docprev_thumb_path') ?? $this->docprev_thumb_path ;
    $this->base_prev_img = config($this->configFile . '.base_prev_img') ?? $this->base_prev_img ;
}

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $doc = Doc::with('category')->where('category_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('originalname', 'LIKE', "%$keyword%")
                ->orWhere('type', 'LIKE', "%$keyword%")
                ->orWhere('note', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $doc = Doc::with('category')->latest()->paginate($perPage);
        }

        return view('admin.doc.index', compact('doc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['cat'] = Category::all();
        $data['id'] =0;
        return view('admin.doc.fileupload',compact('data'));
    }
    public function createWithCat($id)
    {
        $data['cat'] = Category::all();
        $data['id'] =$id;
        return view('admin.doc.fileupload',compact('data'));
    }
    /**
     * Store a newly created resource  in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response|
     */
    public function store(Request $request)
    { 
        //$path =$this->doc_path; 
        $path =resource_path('doc');
        $this->validate($request, [
            'file' => 'required',
            'file.*' => 'mimes:doc,pdf,docx,txt,xls',
        ]);
        $prev_image_array = ['pdf', 'doc'];
        $ext = $request->file->getClientOriginalExtension();
        $filename = rand(1111, 9999) . time() . '.' . $ext;
        $OriginalName = $request->file->getClientOriginalName();

        if (in_array($ext, $prev_image_array)) {$prev = $ext . '.png';} else { $prev = 'file.png';}

        $docdata = [
            'filename' => $filename,
            'category_id'=>$request->cat_id,
            'name' => $OriginalName,
            'originalname' => $OriginalName,
            'type' => $ext,
            'prev' => $prev,
            'sizekb' => $request->file('file')->getSize()];
        Doc::create($docdata);
        request()->file->move($path, $filename);
        return response()->json(['uploaded' => $OriginalName]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $doc = Doc::findOrFail($id);

        return view('admin.doc.show', compact('doc'));
    }
  /*  public function prev($id) //NH átkerült a homeControllerbe
    {
        $doc = Doc::findOrFail($id);
      return response('<img src="'.url('docprev/'.$doc->prev).'" height="600px" width="100%">');
    }*/
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data['doc'] = Doc::findOrFail($id);
        $data['categories'] = Category::all()->pluck('name', 'id');
        return view('admin.doc.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $doc = Doc::findOrFail($id);

        $this->validate($request, [
            //'path' => 'required'
        ]);
        $requestData = $request->all();

        if (Input::file()) {

            $image = Input::file('thumb');
            $ext = $request->thumb->getClientOriginalExtension();
            $prevname = $doc->filename . '.' . $ext;

           $prevpath=public_path($this->docprev_path);
           $thumbpath=public_path($this->docprev_thumb_path); 
          
           if (!in_array($doc->prev , $this->base_prev_img)) {
                  if (file_exists($prevpath. $doc->prev)) {File::delete($prevpath. $doc->prev);}
                  if (file_exists($thumbpath . $doc->prev)) {File::delete($thumbpath . $doc->prev);}
           }
            Image::make($image->getRealPath())->save($prevpath. $prevname);
            Image::make($image->getRealPath())->resize(100, 100)->save( $thumbpath. $prevname);
             $requestData['prev'] = $prevname;
        }

       
        unset($requestData['thumb']);
        $doc->update($requestData);

        return redirect('admin/doc')->with('flash_message', 'Doc updated!');
    }

    /**
     * Remove the specified resource from storage.
     *  
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $doc = Doc::findOrFail($id);
        $file = $this->doc_path. $doc->filename;
        $prew = public_path($this->docprev_path). $doc->prev;
        $thumb =public_path($this->docprev_thumb_path). $doc->prev;
        Doc::destroy($id);
        File::delete($file);
        if(!in_array($doc->prev,$this->base_prev_img)){
            File::delete($prew);
            File::delete($thumb);
        }
       
        return redirect('admin/doc')->with('flash_message', 'Doc deleted!'.$file);
    }
    /**
     * A preview et törli és visszaírja az alap nézetet ext.png
     */
    public function resetPrev($id)
    {
        $doc = Doc::findOrFail($id);
        $type = $doc->type ?? 'file';
        $newPrev = $type . '.png';

        $prew = public_path($this->docprev_path). $doc->prew;
        $thumb = public_path($this->docprev_thumb_path). $doc->prew;
        $doc->updated(['prev' => $newPrev]);
        if(!in_array($doc->prev,$this->base_prev_img)){
            File::delete($prew);
            File::delete($thumb);
        }
        return redirect('admin/doc')->with('flash_message', 'Doc prev reset!');
    }

 
    public function convert($path)
    {
        $imagick = new \Imagick();
        // Reads image from PDF
        $imagick->readImage(resource_path('doc') . $path);

    }
}