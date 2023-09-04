@extends('layouts.master')
@section('css')

@section('title')
        {{ __('main_trans.Exams') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
        {{ __('main_trans.Exams') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10 col-lg-10">
            <div class="border">
                <div class="question bg-white p-3 border-bottom">
                    <div class="d-flex flex-row justify-content-between align-items-center mcq">
                        <h4>{{ $title[0] }}<small><small class=" text-muted">({{ $questions->count() }})</small></small></h4>
                    </div>
                </div>
               
<?php 
$collection = collect([1, 2, 3, 4]);
 
?>

<form action="{{ route('exam.submit') }}" method="post" >
@csrf 

<input type="hidden" name="course_id" value="{{ $myexam->course_id }}">
<input type="hidden" name="code" value="{{ $code[0] }}">
<input type="hidden" name="count" value="{{$questions->count() }}">
@foreach ($questions as $question)
<?php  
$x = $collection->shuffle();

$x->all(); 
?>
  <fieldset id="group1">

     <div class="question bg-white p-3 border-bottom">
                    <div class="d-flex flex-row align-items-center question-title">
                        <h3 class="text-danger">Q.</h3>
                        <h5 class="mt-1 ml-2">
{{ $question->question }}
</h5>
(<p class="text-muted" style="display: block">{{ $question->note }}</p>)
                    </div>
@for ($i=0;$i<4;$i++)
    <?php 
$m='answer'.$x[$i];

 ?>
@if ($question->$m)
    
<div class="ans ml-2">
                        <label class="radio">
 <input type="radio" name="{{ $question->id }}" value="{{  $question->$m}}"> 
<span>
<?php 
echo $question->$m;
?>
</span>
                        </label>
                    </div>
@endif

@endfor
                       </div>
  </fieldset>


  @endforeach

<div class="d-flex flex-row justify-content-between align-items-center p-3 bg-white">
<button class="btn btn-primary d-flex align-items-center btn-danger" type="submit">&nbsp;submit</button>

<input type="reset" value="reset" class="btn btn-primary d-flex align-items-center btn-danger">
</div>
</form>                  
                   
             
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@endsection
