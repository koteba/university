<?php

namespace App\Http\Controllers;

use App\Course;
use App\Meeting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
if(Auth::user()->user_type < 5)
{
$matchCourses=Course::where('teacher',Auth::id())->pluck('id');}


elseif(Auth::user()->user_type == 5)
$matchCourses=DB::table('course_user')->where([
['status',1],
['user_id',Auth::id()],
])->pluck('course_id');

else
return redirect(route('dashboard'));

// $meetings=Meeting::where('course_id',$matchCourses);
// all()->where([['course_id',$matchCourses],['date',date('Y-m-d')]]);
$meetings=Meeting::whereIn('course_id',$matchCourses)->get();
// dd(Auth::id());

$courses=Course::all()->where('teacher',Auth::id());
$old=false;
$date = new Carbon();

return view('pages.meetings.meetings',compact('meetings','courses','old','date'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses=Course::all()->where('teacher',Auth::id());
        return view('pages.meetings.host',compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date=$request->validate([
'date'=>'required|after:yesterday',
'time'=>'required',
'title'=>'required',
'course_id'=>'required',
]);

$meeting=new Meeting();
$meeting->user_id=Auth::id();
$meeting->course_id=$request->course_id;
$meeting->title=$request->title;
$meeting->date=$request->date;
$meeting->time=$request->time;
$meeting->save();
    toastr()->success(trans('meeting.online_lesson_created'));

return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meeting $meeting)
    {
         $date=$request->validate([
'date'=>'required|after:yesterday',
'time'=>'required',
'title'=>'required',
'course_id'=>'required',
]);

$meeting->update($request->all());
    toastr()->success(trans('meeting.online_lesson_created'));

return redirect(route('meeting.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meeting $meeting)
    {
        $meeting->delete();
toastr()->error(__('messages.Delete'));
return redirect()->back();
    }

    public function Download_zoom(){
 return response()->download(public_path('attachments/apps/zoom.rar'));
}

public function old_meetings(){
if(Auth::user()->user_type < 5){
$matchCourses=Course::where('teacher',Auth::id())->pluck('id');
$meetings=Meeting::whereIn('course_id',$matchCourses)->get();
$old=true;
$date = new Carbon();
$courses=Course::all()->where('teacher',Auth::id());

return view('pages.meetings.meetings',compact('meetings','courses','old','date'));

}
else
return redirect()->back();

}
}
