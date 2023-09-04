<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowCollage extends Component
{
   public $name,$name_en,$collages,$create=false  ,  $catchError;

    public function showcreate(){
    $this->create=true;
}
    public function render()
    {
        $this->collages=Collage::all();
        // $this->create=false;
        return view('livewire.show-collage');
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
