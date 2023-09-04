<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message=DB::table('message_user')->where('user_id',Auth::id())->pluck('message_id');
        $messages=Message::find($message);
        return view('pages.message.messages',compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function usread(Message $message)
    {
        $message->read= date('Y-m-d H:i:s');
        $message->update();
        return redirect(route('message.index')) ;
    }

public function Allasread(){
        $messages=DB::table('message_user')->where('user_id',Auth::id())->pluck('message_id');
foreach($messages as $message)
$affected = DB::table('messages')
              ->where('id', $message)
              ->update(['read'=>date('Y-m-d H:i:s')]);
return redirect()->back();
}

public function deleteMessage(Message $message){
$message->users()->detach(Auth::id());
return redirect(route('message.index'));
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
'title'=>'required',
'body'=>'required',
]);
        $message=new Message();
        $message->title=$request->title;
        $message->body=$request->body;
        $message->sender_id=$request->sender;
        $message->department_id= $request->department_id;
        $message->imageable_id= $request->course_id;
        $message->imageable_type = 'App\Course';
        $message->save();

$users=DB::table('course_user')->where([
['course_id',$request->course_id],
['status',2] 
])->pluck('user_id');
// dd($users);
foreach($users as $user)
$message->users()->attach($user);

    toastr()->success(__('messages.message_sent'));

return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
