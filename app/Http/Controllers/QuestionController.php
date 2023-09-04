<?php

namespace App\Http\Controllers;

use App\Course;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Course $course)
    {
          $questions=$course->questions;
    return view('pages.question.questions',compact('course','questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {
        return view('pages.question.create',compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
  public function store(Request $request,Course $course)
  {
    $questions=$request->questions;
try{
foreach($questions as $questionreq)
    {
  $question=new Question();

 $question->question = $questionreq['question'];
 $question->answer1 = $questionreq['answer1'];
 $question->answer2 = $questionreq['answer2'];
 $question->answer3 = $questionreq['answer3'];
 $question->answer4 = $questionreq['answer4'];
 $question->user_id = Auth::id();
 $question->course_id = $course->id;
 
   $question->save();
    }
    toastr()->success(trans('messages.success'));
return redirect(route('course.question.index',$course->id));}
catch (\Exception $e) {
 return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        } 
  }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course,Question $question)
    {
        return view('pages.question.show',compact('course','question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $Question
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course,Question $question)
    {
        return view('pages.user.edit',compact('course','question'));
    }

    
    public function update(Request $request,Course $course, Question $question)
    {
//         $data=$request->validate([
// 'question'=>'required',
// 'answer1'=>'required',
// 'answer2'=>'required',
// 'note'=>'required',
// ]); 

$m=$question->update($request->all());
return redirect()->back(); 
    }

    
    public function destroy(Course $course,Question $question)
    {
        
    
    $question->delete();
  toastr()->error(trans('exam.question_delete'));
return redirect(route('course.question.index',$course->id));
    }
}
