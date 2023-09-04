<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
     protected $table = 'exams';
    public $timestamps = true;
protected $guarded=[];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }
public function messages()
    {
        return $this->morphMany('App\Message', 'imageable');
    }
}
