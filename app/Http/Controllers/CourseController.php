<?php 

namespace App\Http\Controllers;

use App\Course;
use App\Department;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller 
{
/*
status
0-student didnt ask to register a course
1-student asked
2-student accepted
3-success the course
 */ 


  /**
   * Display a listing of the resource.
   *
   * @return Response 
   */
  public function index(Department $department)
  {
    $courses=$department->courses;
    return view('pages.course.courses',compact('courses','department'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create(Department $department)
  {
    $departments=Department::all();
    $users=User::all()->where('department_id','=',$department->id)->whereBetween('user_type', [2, 4]);

    return view('pages.course.create',compact('department','users','departments'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request,Department $department)
  {
    $courses=$request->courses;
try{
foreach($courses as $coursem)
    {
  $course=new Course();

 $course->name = ['en' => $coursem['name_en'], 'ar' => $coursem['name']];
 $course->description = ['en' => $coursem['description_en'], 'ar' => $coursem['description']];
$course->department_id=$coursem['department_id'];
$course->year=$coursem['year'];
$course->season=$coursem['season'];
$course->teacher=$coursem['teacher'];
$course->teacher2=$coursem['teacher2'];
   $course->save();

$students=DB::table('users')->where([
['year','>=',$coursem['year']],
['department_id', $coursem['department_id']]
])->pluck('id');
foreach($students as $student)
$course->users()->attach($student);
    }
    toastr()->success(trans('messages.success'));

return redirect(route('department.course.index',$department->id));}

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
  public function show(Department $department,Course $course)
  {
    $users=User::all()->where('department_id','=',$department->id)->whereBetween('user_type', [2, 4]);
    // dd($users);
return view('pages.course.show',compact('department','course','users'));
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit(Department $department,Course $course)
  {
    $users=User::all()->where('department_id','=',$department->id)->whereBetween('user_type', [2, 4]);
    return view('pages.course.edit',compact('department','course','users'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Department $department,Request $request,Course $course)
  {
try{
     $data=$request->validate([
      "name"=>"required",
      "name_en"=>"required",
      "year"=>"required"
    ]);

 $course->name = ['en' => $request->name_en, 'ar' => $request->name];

 $course->description = ['en' => $request->description_en, 'ar' => $request->description];

$course->department_id=$department->id;
$course->year=$request->year;
$course->season=$request->season;
if($request->teacher)
$course->teacher=$request->teacher;
if($request->teacher2)
$course->teacher2=$request->teacher2;
   $course->save();
    toastr()->success(trans('messages.success'));

return redirect(route('department.course.index',$department->id));}

catch (\Exception $e) {
 return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        } 
  
 
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Department $department,Course $course)
  {
    
    $course->delete();
  toastr()->error(trans('Collages_trans.delete_Collage'));
return redirect(route('department.course.index',$department->id));
  }
  


public function myCourses($id){
$courses=User::find($id)->courses()->where('status',2) ->orderBy('year', 'desc')->get();
$teacher_courses=Course::where('teacher',$id)->orderBy('year', 'desc')->get();
// $teacher_courses=User::find($id)->courses()->where('status',0)->orderBy('year', 'desc')->get();
// dd($teacher_courses);
return view('pages.course.myCourses',compact('courses','teacher_courses'));
}


public function oldCourses(){
$matchCourses=DB::table('course_user')->where([
['status',0],
['user_id',Auth::id()],
])->pluck('course_id');
$courses = Course::find($matchCourses)->groupBy('year');


return view('pages.course.oldCourses',compact('courses'));
}


public function signOldCourse(Request $request){
$user_id=$request->user_id;
$course_id=$request->course_id;
$affected = DB::table('course_user')
              ->where([
              ['user_id', $user_id],
              ['course_id', $course_id]])
              ->update(['status'=>1]);

        return response()->json($affected,200);

}

public function unsignOldCourse(Request $request){
$user_id=$request->user_id;
$course_id=$request->course_id;
$affected = DB::table('course_user')
              ->where([
              ['user_id', $user_id],
              ['course_id', $course_id]])
              ->update(['status'=>0]);

        return response()->json($affected,200);

}


public function acceptOldCourse(Request $request){
$user_id=$request->user_id;
$course_id=$request->course_id;
$affected = DB::table('course_user')
              ->where([
              ['user_id', $user_id],
              ['course_id', $course_id]])
              ->update(['status'=>2]);

        return response()->json($affected,200);

}

public function denyOldCourse(Request $request){
$user_id=$request->user_id;
$course_id=$request->course_id;
$affected = DB::table('course_user')
              ->where([
              ['user_id', $user_id],
              ['course_id', $course_id]])
              ->update(['status'=>0]);

        return response()->json($affected,200);

}

public function acceptCourseSign(){

$match_courses=DB::table('course_user')
              ->where('status',1)
              ->pluck('course_id');
$courses=Course::find($match_courses)->groupBy('year');

return view('pages.course.acceptCourses',compact('courses'));

}
public function students(Course $course){
$s=DB::table('course_user')->where('course_id',$course->id)->pluck('user_id');
$users = User::find($s)->where('user_type',5);

return view('pages.course.students',compact('users','course'));
}

}

?>