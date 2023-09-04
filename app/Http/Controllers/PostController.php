<?php

namespace App\Http\Controllers;
use App\Image;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::all()->sortByDesc('created_at');
        return view('pages.post.posts',compact('posts'));
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
    public function store(Request $request)
    {
        $this->validate(request(),[
            'title'=>'required',
            'body'=>'required',
            ]);
 DB::beginTransaction();
try{
    $post = new Post;
    $post->title=request('title');
    $post->body=request('body');
    $post->user_id=Auth::id();
    $post->save();
// dd($request->hasFile('url'));
if($request->hasfile('photos'))
            {
                foreach($request->file('photos') as $file)
                {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/posts/', $file->getClientOriginalName(),'upload_attachments');

                    // insert in image_table
                    $images=new Image();
                    $images->filename=$name;
                    $images->imageable_id= $post->id;
                    $images->imageable_type = 'App\Post';
                    $images->save();
                }
            }
            DB::commit();
    toastr()->success(trans('lecture.lecture_added'));
return redirect(route('post.index'));}
catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('pages.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
          $data=request()->validate([
            'title'=>'required',
            'body'=>'required',
            'user_id'=>'required',


        ]);
        $post->update($data);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
foreach($post->images as $image)
        {Storage::disk('upload_attachments')->delete('attachments/posts/'. $image->filename);

        // Delete in data
        Image::where('id',$image->id)->where('filename',$image->filename)->delete();
}
$post->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('post.index');
   
    }

 public function Download_attachment( Image $image)
    {
        return response()->download(public_path('attachments/posts/'.$image->filename));
    }

    public function Delete_attachment(Request $request,Post $post)
    {
        // Delete img in server disk
        Storage::disk('upload_attachments')->delete('attachments/posts/'. $request->filename);

        // Delete in data
        Image::where('id',$request->id)->where('filename',$request->filename)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('course.lecture.show',[$post->course->id,$post->id]);
    }
}
