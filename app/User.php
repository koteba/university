<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Translatable\HasTranslations;

// api key
// Kl_68qFDSFG5nNMk49_KVQ

// api secret
// rM7VGnc2PJljEMdOcPwzPbSOofG7qyFyHE1l

// im chat history token
// eyJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJUQU5ZSU9aNlFEU0dkZ2dESEYtZ0hnIn0.nenDgdYZPgrg6faGFjQroBiG_RRtMOtSeYjK9g3pPms

// jwt token
// eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6IktsXzY4cUZEU0ZHNW5OTWs0OV9LVlEiLCJleHAiOjE2MjQwNTIxNTcsImlhdCI6MTYyNDA0Njc0M30.VDLdunu1reDiFzhGixyfY2E9dB5lJfemcbYdZy5SviY

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','department_id','year','specification','user_type','photo'
    ];
/*
user_type
1 - admin
2 - department head
3 - teacher
4 - teacher2
5 - student
7 - teacher to confirm 

*/

use HasTranslations;
    public $translatable = ['name','specification'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

public function department(){
return $this->belongsTo(Department::class);
}

public function courses(){
return $this->belongsToMany(Course::class);
}

public function questions(){
return $this->hasMany(Question::class);
}

public function posts(){
return $this->hasMany(Post::class);
}

public function comments(){
return $this->hasMany(Comment::class);
}
public function meetings(){
return $this->hasMany(Meeting::class);
}

public function exams(){
return $this->belongsToMany(Exam::class);
}

public function lectures(){
return $this->hasMany(Lecture::class);
} 


public function messages(){
return $this->belongsToMany(Message::class);
}

public function un_read(){
$message=DB::table('message_user')->where('user_id',Auth::id())->pluck('message_id');
$messages=Message::find($message)->whereNull('read');
return $messages->count();
}
}
