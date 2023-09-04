<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
      protected $table = 'meetings';
      public $timestamps = true;
     protected $guarded=[];

public function course(){
return $this->belongsTo(Course::class);
}

public function user(){
return $this->belongsTo(User::class);
}

}
