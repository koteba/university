@extends('layouts.master')
@section('css')

@section('title')
    {{ __('exam.create_exam') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('exam.create_exam') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')


   <div class="modal-body">
 @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
              <br>
            <div class="card-body">
                <!-- add_form -->
                <form action="{{ route('exam.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                              <label for="course_id" class="col-md-4 col-form-label text-md-right">{{ __('course.Course') }}</label>
 
                              <div class="col-md">

<div class="input-group mb-3">
  <select name="course_id" class="custom-select" id="course_id" onchange="console.log($(this).val())">
    <option selected  disabled>Choose...</option>
@foreach ($courses as $course)
  <option value="{{ $course->id }}">
          {{ $course->name }}
   </option>
          @endforeach
  </select>
  <div class="input-group-append">
    <label class="input-group-text" for="inputGroupSelect02">{{ __('course.Course') }}</label>
  </div>
</div>
                                @error('course_id')
                                    <span class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <label for="numofquestions" class="mr-sm-2">{{ trans('exam.numofquestions') }}
                                :</label>
                            <input type="number" class="form-control" name="numofquestions">
                            @error('numofquestions')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col">
                            <label for="date" class="mr-sm-2">{{ trans('exam.date') }}
                                :</label>
                            <input type="date" class="form-control" name="date">
                            @error('date')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div><div class="row">

<div class="col">
                            <label for="time" class="mr-sm-2">{{ trans('exam.time') }}
                                :</label>
                            <input type="time" class="form-control" name="time">
                            @error('time')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
<div class="col">
                            <label for="duration" class="mr-sm-2">{{ trans('exam.duration') }}
                                :</label>
                            <input type="number" class="form-control" name="duration" placeholder="(in minutes)">
                            @error('duration')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>

<div class="col">
                            <label for="totalmark" class="mr-sm-2">{{ trans('exam.totalMark') }}
                                :</label>
                            <input type="text" class="form-control" name="totalmark" >
                            @error('totalmark')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
 </div>
                    <div class="row">

<div class="col">
                            <label for="title" class="mr-sm-2">{{ trans('exam.title') }}
                                :</label>
                            <input type="text" class="form-control" name="title" >
                            @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
<div class="col border border-danger">
                            <label for="code" class="mr-sm-2">{{ trans('exam.code') }}
                                :</label>
                            <input type="text" class="form-control" name="code">
                            @error('code')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                   
                    <br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                     >{{ trans('Collages_trans.Close') }}</button>
                <button type="submit" class="btn btn-success">
{{ trans('Collages_trans.submit') }}
</button>
            </div>
            </form>

        </div>
    


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
