<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Course extends Model 
{

    protected $table = 'courses';
    public $timestamps = true;
 use HasTranslations;
    public $translatable = ['name','description'];
protected $guarded=[];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }


public function meetings(){
return $this->hasMany(Meeting::class);
}
public function users(){
return $this->belongsToMany(User::class);
}

public function questions(){
return $this->hasMany(Question::class);
}
public function lectures(){
return $this->hasMany(Lecture::class);
}
public function exams(){
return $this->hasMany(Exam::class);
}
public function x($id){
//get all department teachers
    $users=User::all()->where('department_id','=',$id)->whereBetween('user_type', [2, 4]);
return $users;
}

public function messages()
    {
        return $this->morphMany('App\Message', 'imageable');
    }
} 