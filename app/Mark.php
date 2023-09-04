<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model 
{

    protected $table = 'marks';
    public $timestamps = true;
    protected $guarded=[];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}