<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Department extends Model 
{

    protected $table = 'departments';
    public $timestamps = true;
    use HasTranslations;
    public $translatable = ['name'];
protected $guarded=[];

    public function collage()
    {
        return $this->belongsTo(Collage::class);
    }

      public function courses()
    {
        return $this->hasMany(Course::class);
    }

public function users(){
return $this->hasMany(User::class);
}
} 