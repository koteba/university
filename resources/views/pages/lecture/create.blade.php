@extends('layouts.master')
@section('css')

@section('title')
    {{ __('lecture.add_lecture') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('lecture.add_lecture') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')


 @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
              <br>
                <!-- add_form -->
 <form  action="{{ route('course.lecture.store',$course->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            
                            <input id="title" type="text" name="title" class="col-12 form-control-sm border" placeholder="{{ __('exam.title') }}">
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
</div>
 <div class="row" >

                        <div class="col mt-3">
                            
<textarea name="note" id="note" cols="70" rows="3" placeholder="{{ __('exam.notes') }}" class="form-control border"></textarea>
                            @error('note')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        </div>
<div class="col-3 form-control" style="display: flex; justify-content: space-around;" >
<label class="btn btn-default btn-sm center-block btn-file" style="position: relative;">
  <i class="fa fa-upload fa-2x" aria-hidden="true" style="position: absolute;top:50%;left:50%;    transform: translate(-50%, -50%);" ></i>
  <input type="file" id="photos" name="photos[]" style="display:none ;" multiple accept=".jpg,.png,.gif,.jpeg,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
<span id="xx"></span>
</label>

<button type="submit" class="btn btn-success mt-3 mb-3">
{{ trans('post.post') }}
</button>
</div>

                    </div>
                   
                    <br><br>
           
            </form>

        </div>
    


            </div>
        </div>






<!-- row closed -->
@endsection
@section('js')
<script>
$(document).ready(function () {
$('#photos').on('change', function () {
var num_of_images = $("#photos")[0].files.length;
var paragraph = document.getElementById("xx");

paragraph.textContent = "("+num_of_images+") file(s) selected";});
});
</script>
@endsection