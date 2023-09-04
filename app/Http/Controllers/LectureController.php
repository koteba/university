<?php

namespace App\Http\Controllers;

use App\Course;
use App\Image;
use App\Lecture;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Course $course)
    {
        $lectures=$course->lectures;
    return view('pages.lecture.lectures',compact('course','lectures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {
        return view('pages.lecture.create',compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Course $course)
    {
 $this->validate(request(),[
            'title'=>'required',
            ]);
        DB::beginTransaction();
try{
        
// **********************
$lecture=new Lecture();
$lecture->title=request('title');
$lecture->note=request('note');
$lecture->user_id=Auth::id();
$lecture->course_id=$course->id;
$lecture->save();
  
if($request->hasfile('photos'))
            {
                foreach($request->file('photos') as $file)
                {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/lectures/'.$lecture->course->department->collage->getTranslation('name', 'en').'/'.$lecture->course->department->getTranslation('name', 'en').'/'.$lecture->course->getTranslation('name', 'en'), $file->getClientOriginalName(),'upload_attachments');

                    // insert in image_table
                    $images=new Image();
                    $images->filename=$name;
                    $images->imageable_id= $lecture->id;
                    $images->imageable_type = 'App\Lecture';
                    $images->save();
                }
            }
            DB::commit();


// **********************
$message=new Message();

 $message->title = ['en' => $lecture->course->getTranslation('name', 'en'), 'ar' => $lecture->course->getTranslation('name', 'ar')];
 $message->body = ['en' => 'new lecture uploaded with title :'.$lecture->title, 'ar' => 'تمت إضافة محاضرة جديدة بعنوان :'.$lecture->title];
$message->sender_id=Auth::id();
$message->department_id=$lecture->course->department_id;
$message->imageable_id= $lecture->id;
 $message->imageable_type = 'App\Lecture';
   $message->save();

$users=DB::table('course_user')->where([
['course_id',$lecture->course->id],
['status',2] 
])->pluck('user_id');
// dd($users);
foreach($users as $user)
$message->users()->attach($user);

    toastr()->success(trans('lecture.lecture_added'),$course->name);

        return back()
            ->with('success','You have successfully upload file.');}
            // ->with('file',$fileName);
catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course,Lecture $lecture)
    {
                return view('pages.lecture.show',compact('course','lecture'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course,Lecture $lecture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Course $course, Lecture $lecture)
    {
        $lecture->update($request->all());
return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course,Lecture $lecture)
    {
        $lecture->delete();
  toastr()->error(trans('messages.Delete'));

return redirect()->back();
    }

public function Upload_attachment(Request $request,Lecture $lecture){
foreach($request->file('photos') as $file)
        {
            $name = $file->getClientOriginalName();
  $file->storeAs('attachments/lectures/'.$lecture->course->department->collage->getTranslation('name', 'en').'/'.$lecture->course->department->getTranslation('name', 'en').'/'.$lecture->course->getTranslation('name', 'en'), $file->getClientOriginalName(),'upload_attachments');

            // insert in image_table
            $images=new Image();
                    $images->filename=$name;
                    $images->imageable_id= $lecture->id;
                    $images->imageable_type = 'App\Lecture';
                    $images->save();
        }
       toastr()->success('ok');

        return back()
            ->with('success','You have successfully upload file.');
}


 public function Download_attachment(Lecture $lecture, Image $image)
    {
        return response()->download(public_path('attachments/lectures/'.$lecture->course->department->collage->getTranslation('name', 'en').'/'.$lecture->course->department->getTranslation('name', 'en').'/'.$lecture->course->getTranslation('name', 'en').'/'.$image->filename));
    }

    public function Delete_attachment(Request $request,Lecture $lecture)
    {
        // Delete img in server disk
        Storage::disk('upload_attachments')->delete('attachments/lectures/'.$lecture->course->department->collage->getTranslation('name', 'en').'/'.$lecture->course->department->getTranslation('name', 'en').'/'.$lecture->course->getTranslation('name', 'en').'/'. $request->filename);

        // Delete in data
        Image::where('id',$request->id)->where('filename',$request->filename)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('course.lecture.show',[$lecture->course->id,$lecture->id]);
    }

}
