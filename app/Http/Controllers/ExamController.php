<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Message;
use App\Question;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
 public function index(Request $request)
    {   $data=$request->validate([
'code'=>'required'
]);
 $now = Carbon::now();
  $today = Carbon::parse($now)->toDateString();

        $exam=DB::table('exams')->where('code',$request->code)->pluck('id');
        $date=DB::table('exams')->where([['code',$request->code],
                                        ['date',$today]
])->count();
        $time=DB::table('exams')->where('code',$request->code)->pluck('time');
$exist=DB::table('exam_user')->where([
['exam_id',$exam],
['user_id',Auth::id()]
])->count();
if ($exist || ($date == 0)) {
toastr()->warning(__('exam.failed_enter_exam'),__('exam.error'));
 
    return redirect(route('dashboard'));
} else {
Auth::user()->exams()->attach($exam);
$myexam=Exam::where('code',$request->code)->first();
$title=DB::table('exams')->where('code',$request->code)->pluck('title');
$duration=DB::table('exams')->where('code',$request->code)->pluck('duration');
$code=DB::table('exams')->where('code',$request->code)->pluck('code');
        $exam_questions=DB::table('exam_question')->where('exam_id',$exam)->pluck('question_id');
        $questions=Question::find($exam_questions);

        return view('pages.exam.exam',compact('questions','title','code','myexam','duration'));}
    }

 public function code()
    {
        return view('pages.exam.code');
    }


 public function submit(Request $request)
    {
$exam=DB::table('exams')->where('code',$request->code)->pluck('totalmark');
 $ex=DB::table('exams')->where('code',$request->code)->pluck('id');
$question_mark=$exam[0]/$request->count;
 $exam_questions=DB::table('exam_question')->where('exam_id',$ex)->pluck('question_id');
$questions=Question::find($exam_questions);
$mark=0;
// dd($ex[0]);
foreach($questions as $question)
{$m=$question->id;

if($request->$m==$question->answer1)
$mark+=$question_mark;}
$affected = DB::table('exam_user')
              ->where('exam_id', $ex[0])
              ->update(['mark'=>$mark]);
if ($mark>=60) {
       toastr()->success(__('exam.you_passed').ceil($mark),__('exam.success'));
$course_id=$request->course_id;
$affected = DB::table('course_user')
              ->where([
              ['user_id', Auth::id()],
              ['course_id', $course_id]])
              ->update(['status'=>3]);

} else {
      toastr()->error(__('exam.you_failed').ceil($mark),__('exam.failed'));
}
        return redirect(route('dashboard'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
$courses=Auth::user()->courses;
 return view('pages.exam.create',compact('courses'));

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
$data=$request->validate([
'duration'=>'required',
'totalmark'=>'required|max:100|min:0',
'course_id'=>'required',
'date'=>'required|date|after:yesterday',
'time'=>'required',
'code'=>'required',
'title'=>'required',
'numofquestions'=>'required',

]);
$exam = new Exam();
$exam->duration=$request->duration;
$exam->date=$request->date;
$exam->course_id=$request->course_id;
$exam->time=$request->time;
$exam->numofquestions=$request->numofquestions;
$exam->totalmark=$request->totalmark;
$exam->code=$request->code;
$exam->title=$request->title;
$exam->status=1;


$questions=Question::inRandomOrder()->limit($request->numofquestions)->where('course_id',$request->course_id)->pluck('id');
$x=count($questions);
if($x<$request->numofquestions)
 return redirect()->back()->withErrors(['error' =>__('exam.not_Enough_QUESTION')."($x)" ]);
$exam->save();
$message=new Message();

 $message->title = ['en' => $exam->course->getTranslation('name', 'en'), 'ar' => $exam->course->getTranslation('name', 'ar')];
 $message->body = ['en' => 'new exam assigned in : ' . $exam->date, 'ar' => "تم تحديد امتحان جديد في :" . $exam->date];
$message->sender_id=Auth::id();
$message->department_id=$exam->course->department_id;
$message->imageable_id= $exam->id;
 $message->imageable_type = 'App\Exam';
   $message->save();
$users=DB::table('course_user')->where([
['course_id',$exam->course->id],
['status',2]
])->pluck('user_id');
// dd($users);
foreach($users as $user)
$message->users()->attach($user);


foreach($questions as $question)
$exam->questions()->attach($question);


    toastr()->success(trans('messages.success'));

 return redirect(route('exam.create'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        //
    }
}
