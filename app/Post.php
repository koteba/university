<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
    protected $table = 'posts';
    public $timestamps = true;
protected $guarded=[];

public function user(){
return $this->belongsTo(User::class);
}
// public function comments(){
// return $this->hasMany(Comment::class);
// }

public function comments()
    {
        return $this->morphMany('App\Comment', 'imageable');
    }
public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }
}
