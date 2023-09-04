<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Collage extends Model 
{
    protected $guarded=[];
    protected $table = 'collages';
    public $timestamps = true;
    use HasTranslations;
    public $translatable = ['name'];

public function departments(){
return $this->hasMany(Department::class);
}

}