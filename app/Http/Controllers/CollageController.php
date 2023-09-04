<?php 

namespace App\Http\Controllers;

use App\Collage;
use Illuminate\Http\Request;

class CollageController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $collages=Collage::all();
  return view('pages.collage.collages',compact('collages'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('pages.collage.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $data=$request->validate([
      "name"=>"required",
      "name_en"=>"required"
    ]);
  $collage=new Collage();

 $collage->name = ['en' => $request->name_en, 'ar' => $request->name];
   $collage->save();
toastr()->success(__('admin.messages_create'),$collage->name);

return redirect(route('collage.index'));

  }

  

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit(Collage $collage)
  {
    return view('pages.collage.edit',compact('collage'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request,Collage $collage)
  {
     $data=$request->validate([
      "name"=>"required",
      "name_en"=>"required"
    ]);
 $collage->name = ['en' => $request->name_en, 'ar' => $request->name];
           
            $collage->update();
            toastr()->warning(trans('admin.messages_update'),$collage->name);
            return redirect()->route('collage.index');
        
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Collage $collage)
  {
   toastr()->error(trans('admin.messages_delete'),$collage->name);
    $collage->delete();
return redirect(route('collage.index'));
  }
  
}

?>