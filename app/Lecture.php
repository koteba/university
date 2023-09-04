<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
       protected $table = 'lectures';
    public $timestamps = true;
protected $guarded=[];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
 public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }

public function comments()
    {
        return $this->morphMany('App\Comment', 'imageable');
    }
public function messages()
    {
        return $this->morphMany('App\Message', 'imageable');
    }
}
