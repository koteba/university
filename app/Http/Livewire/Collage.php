<?php

namespace App\Http\Livewire;

use App\Collage as AppCollage;
use Livewire\Component;
// use Livewire\WithFileUploads;

class Collage extends Component
{
// use WithFileUploads;
    public $name,$name_en,$collages,$create=false  ,  $catchError;

    public function showcreate(){
    $this->create=true;
}
    public function render()
    {
        $this->collages=AppCollage::all();
        // $this->create=false;
        return view('livewire.collage');
    }

    public function store(){
    try {
            $collage = new Collage();
 $collage->name = ['en' => $this->name_en, 'ar' => $this->name];            $collage->save();
            $this->clearForm();

    }
catch (\Exception $e) {
   $this->catchError = $e->getMessage();
        }

}

public function clearForm(){
$this->create=false;
$this->name_en='';
$this->name='';
$this->catchError='';
}
}
