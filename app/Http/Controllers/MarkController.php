<?php

namespace App\Http\Controllers;

use App\Imports\ImportMarks;
use App\Mark;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Exports\ExportMarks;
use Maatwebsite\Excel\Facades\Excel;
class MarkController extends Controller
{
     public function importExport()
    {
       return view('pages.excel.‫importMarks ');
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function export() 
    // {
    //     return Excel::download(new ExportMarks(), 'marks.xlsx');
    // }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request) 
    {
    $this->validate($request,['file'=>'required|mimes:xls,xlsx']);
        Excel::import(new ImportMarks, request()->file('file'));
        return back();


    }


public function index(){
$courses=User::find(Auth::id())->courses()->where('status',2) ->orderBy('year', 'desc')->get();
$mark=null;
return view('pages.course.marks',compact('mark','courses'));
}

public function checkMark(Request $request){
$mark=Mark::where([['course_id',$request->course_id],['user_id',Auth::id()]])->orderBy('created_at', 'desc')->first();
// $mark=DB::table('marks')->where([['course_id',$course->id],['user_id',Auth::id()]])->orderBy('created_at', 'desc')->first();
$courses=User::find(Auth::id())->courses()->where('status',2) ->orderBy('year', 'desc')->get();
// $courses=null;

return view('pages.course.marks',compact('mark','courses'));
}
}
