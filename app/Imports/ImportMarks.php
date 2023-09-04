<?php

namespace App\Imports;

use App\Course;
use App\Mark;
use App\Message;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportMarks implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function  collection(Collection $rows)
    {
 foreach ($rows as $row) 
        {
Mark::create([
            'user_id' => $row['user_id'],
            'course_id' => $row['course_id'],
            'mark' => $row['mark'],
           
        ]);
}
$mark=Mark::latest()->first();
    toastr()->success(trans('messages.success'));

$message=new Message();

 $message->title = ['en' => $mark->course->getTranslation('name', 'en'), 'ar' => $mark->course->getTranslation('name', 'ar')];
 $message->body = ['en' => 'Course grade posted', 'ar' => 'تم نشر علامات مقرر'];
$message->sender_id=Auth::id();

$message->department_id=$mark->course->department_id;
$message->imageable_id= $mark->course->id;
 $message->imageable_type = 'App\Course';
   $message->save();

$users=DB::table('course_user')->where([
['course_id',$mark->course->id],
['status',2] 
])->pluck('user_id');
foreach($users as $user)
$message->users()->attach($user);

return redirect(view('pages.excel.import'));
    }

public function headingRow(): int
    {
        return 3;
    }
}


