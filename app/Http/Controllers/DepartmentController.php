<?php 

namespace App\Http\Controllers;

use App\Collage;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $departments=Department::all();
  return view('pages.department.departments',compact('departments')); 
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $collages=Collage::all();
    return view('pages.department.create',compact('collages'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
  $departments=$request->departments;
try{
foreach($departments as $departmentm)
    {
// $data=$departmentm->validate([
//       "name"=>"required",
//       "name_en"=>"required",
//       "collage_id"=>'required',
//       "years"=>"required"
//     ]);
  $department=new Department();

 $department->name = ['en' => $departmentm['name_en'], 'ar' => $departmentm['name']];
$department->collage_id=$departmentm['collage_id'];
$department->years=$departmentm['years'];
   $department->save();
    }
    toastr()->success(trans('messages.success'));

return redirect(route('department.index'));}

catch (\Exception $e) {
 return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        } 
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit(Department $department)
  {
    $collages=Collage::all();
return view('pages.department.edit',compact('collages','department'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Department $department,Request $request)
  {
     $data=$request->validate([
      "name"=>"required",
      "name_en"=>"required",
      "collage_id"=>'required',
      "years"=>"required"
    ]);

 $department->name = ['en' => $request->name_en, 'ar' => $request->name];
$department->collage_id=$request->collage_id;
$department->years=$request->years;
   $department->save();
    toastr()->success(trans('messages.success'));

return redirect(route('department.index'));
 
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Department $department)
  {
    
    $department->delete();
  toastr()->error(trans('Collages_trans.delete_Collage'));
return redirect(route('department.index'));
  }
  
public function getDepartments(Request $request){
// dd($response);
$response = Department::all()->where("collage_id", $request->collage_id)->pluck("name", "id");

return response()->json($response);} 
}

?>