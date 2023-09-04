<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Message extends Model
{
    protected $guarded=[];
 use HasTranslations;
    public $translatable = ['title','body'];
    
public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function imageable()
    {
        return $this->morphTo();
    }

    public function sender($id){
     return   User::find($id);
}
}
 