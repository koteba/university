<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Course;
use App\Lecture;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        $comments=$post->comments;
    return view('',compact('post','comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Post $post)
    {
       $this->validate(request(),[
            'body'=>'required',
            ]);
try{
    $comment = new Comment();
    $comment->imageable_id= $post->id;
     $comment->imageable_type = 'App\Post';

    // $comment->post_id=$post->id;
    $comment->body=request('body');
    $comment->user_id=Auth::id();
    $comment->save();
    
return redirect(route('post.show',$post->id));}
catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }}
    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
public function storeForLecture( Course $course,Lecture $lecture){

       $this->validate(request(),[
            'body'=>'required',
            ]);
try{
    $comment = new Comment();
    $comment->imageable_id= $lecture->id;
     $comment->imageable_type = 'App\Lecture';

    $comment->body=request('body');
    $comment->user_id=Auth::id();
    $comment->save();
    
return redirect(route('course.lecture.show',[$course->id,$lecture->id]));}
catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
}
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post,Comment $comment)
    {
        $comment->delete();
 toastr()->error(trans('messages.Delete'));
        return redirect()->route('post.show',$comment->post->id);
    }


    public function destroyForLecture(Course $course,Lecture $lecture,Comment $comment)
    {
        $comment->delete();
 toastr()->error(trans('messages.Delete'));
        return redirect()->route('course.lecture.show',[$course->id,$lecture->id]);
    }
}
