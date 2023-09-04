<?php 

namespace App\Http\Controllers;

use App\Collage;
use App\Course;
use App\Department;
use App\Image;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Environment\Console;

class UserController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {$conf =1;
$users=User::all();
    $title='users';
    $xxx=User::all()->where('department_id',null);
    $collages=Collage::all();
return view('pages.user.users',compact('xxx','collages','title','conf','users'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
  $collages=Collage::all();
  $departments=Department::all();
    return view('pages.user.create',compact('departments','collages'));
  }
 
  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show(User $user)
  {
    $c=DB::table('course_user')->where('user_id',$user->id)->pluck('course_id');
$courses = Course::find($c);
    return view('pages.user.show',compact('user','courses'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response 
   */
  public function edit(User $user)
  {
// $dep=Department::all()->where('id',$user->department_id);
// $user_collage=Collage::all()->where('id',$dep->collage_id);
  $collages=Collage::all();
  // $departments=Department::all();
    return view('pages.user.edit',compact('user','collages'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request,User $user)
  {
if($request->user_type==5)
    {$request->validate([
'name'=>'required',
'name_en'=>'required',
'department_id'=>'required',
'year'=>'required',
'phone'=>'required', 
]);
$email=$request->email?$request->email:$user->email;
$password=$request->password?$request->password:$user->password;
if($request->hasfile('photo')){
$file =$request->file('photo');
 $name = $user->getTranslation('name','en').time().'.'.$file->getClientOriginalExtension();
                    $file->storeAs('attachments/profiles/', $name,'upload_attachments');

$affected = DB::table('users')
              ->where('id', $user->id)
              ->update([
'name' =>['en' => $request->name_en, 'ar' => $request->name],
'department_id' => $request->department_id,
'year' => $request->year,
'email' => $email,
'password' =>Hash::make($password) ,
'phone' => $request->phone,
'user_type' => $request->user_type,
'photo'=>$name,
]);}
else{
$affected = DB::table('users')
              ->where('id', $user->id)
              ->update([
'name' =>['en' => $request->name_en, 'ar' => $request->name],
'department_id' => $request->department_id,
'year' => $request->year,
'phone' => $request->phone,
'user_type' => $request->user_type,
]);
}

$courses=DB::table('courses')->where([
    ['year','<=',$request->year],
    ['department_id', $request->department_id],
])->pluck('id');
foreach($courses as $course)
$user->courses()->attach($course);


}
else{
$request->validate([
'name' =>['en' => $request->name_en, 'ar' => $request->name],
'department_id'=>'required',
'name'=>'required',
'name_en'=>'required',
'specification'=>'required',
'specification_en'=>'required',
'phone'=>'required',
]);
$email=$request->email?$request->email:$user->email;
$password=$request->password?$request->password:$user->password;
if($request->hasfile('photo')){
$file =$request->file('photo');
 $name = $user->getTranslation('name','en').time().'.'.$file->getClientOriginalExtension();
                    $file->storeAs('attachments/profiles/', $name,'upload_attachments');

$affected = DB::table('users')
              ->where('id', $user->id)
              ->update([
'name' =>['en' => $request->name_en, 'ar' => $request->name],
'department_id' => $request->department_id,
'year' => $request->year,
'email' => $email,
'password' => $password,
'phone' => $request->phone,
'user_type' => $request->user_type,
'photo'=>$name,
]);}
else{
$affected = DB::table('users')
              ->where('id', $user->id)
              ->update([
'department_id' => $request->department_id,
'specification' =>['en' => $request->specification_en, 'ar' => $request->specification],
'name' =>['en' => $request->name_en, 'ar' => $request->name],
'phone' => $request->phone,
'user_type' => $request->user_type,

]);}

 
}

   toastr()->info(__('admin.messages_welcome'),$user->name);
if($request->edit)
return redirect(route('user.show',Auth::id()));
return redirect(route('dashboard'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    
  }


public function teacher(){
$collages=Collage::all();
return view('register_teacher',compact('collages'));
}


public function student(){
$collages=Collage::all();
return view('register_student',compact('collages'));
}
  
public function teachers(){
$users  = DB::table('users')
                ->where([
    ['user_type','>=',  '2'],
    ['user_type','<', '5'],])->get();


    $collages=Collage::all();

    $title='teachers';
    $conf =1;
    $xxx=DB::table('users')->where([
                      ['user_type','7'],
                      ['department_id','null']
])->get();

return view('pages.user.users',compact('users','collages','title','conf','xxx'));
}

public function confirm_teachers(){
    $title='confirm_teachers';
$users  = DB::table('users')
                ->where('user_type',  '7')
                ->get();
    $collages=Collage::all();
$conf = DB::table('users')->where('user_type','7')->count();
$xxx=DB::table('users')->where([['user_type','7'],['department_id','null']])->get();
return view('pages.user.users',compact('users','collages','title','conf','xxx'));

}

public function students(){
$conf =1;
    $title='students';
$users  = DB::table('users')
                ->where([['user_type','5'],['department_id','<>',null]])
                ->get();
    $collages=Collage::all();
$xxx=DB::table('users')->where([['user_type','5'],['department_id',null]])->get();
return view('pages.user.users',compact('users','collages','title','conf','xxx'));
}


 
  public function confirm_teacher(User $user){
$affected = DB::table('users')
              ->where('id', $user->id)
              ->update(['user_type'=>'3']);
   toastr()->success(trans('admin.messages_confirm'),$user->name);
return redirect(route('confirm_teachers'));
}

public function updateRole(Request $request){ 
$data=$request->user_type;
$affected = DB::table('users')
              ->where('id', $request->user_id)
              ->update(['user_type'=>$data]);

        return response()->json($affected,200);
}
public function updateCourses(Request $request){ 
// $user = DB::table('users')
//               ->where('id', $request->user_id)
//               ->get();
$user=User::find($request->user_id);


// dd($user->courses()->syncWithoutDetaching($course));
 $course = Course::find($request->courses);

$user->courses()->sync($course);


// $user->courses()->attach($request->teacher_courses);
        return redirect(route('teachers'));
}

}

?>