@extends('layouts.master')
@section('css')

@section('title')
    {{ __('course.myCourses') }}
@stop 
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('course.myCourses') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

 @if (Auth::user()->user_type==5)
             
<a class="btn btn-success btn-sm btn-lg pull-right"
 href="{{ route('oldCourses')}}">
{{ __('course.SignForOldCourses') }}
</a>
<br>
@endif
<br>

    <div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>id</th>
            <th>{{ __('department.Course') }}</th>
            <th>{{ __('department.Year') }}</th>
            <th>{{ __('department.Collage') }}</th>
            <th>{{ __('department.department') }}</th>
            <th>{{ trans('Collages_trans.Processes') }}</th>
        </tr>
        </thead>
        <tbody>
@if ($courses)
        @foreach ($courses as $course)
            <tr>
                <td>{{ $course->id }}</td>
                <td>{{ $course->name }}</td>
                <td>{{ $course->year }}</td>
<td>
{{ $course->department->collage->name }}
</td>
<td>
	{{ $course->department->name }}	
</td>
    <td style="display: flex;justify-content:center">
  <a href="{{ route('course.lecture.index',$course->id) }}" class="btn btn-primary mr-3" >{{ __('lecture.lectures') }} ( {{ $course->lectures->count() }} ) </a>
        {{-- <a href="#" title="{{ trans('department.Show') }}"
                class="btn btn-warning btn-sm mr-3"><i class="fa fa-eye"></i></a> --}}

                </td>
            </tr>
        @endforeach
@endif
@if ($teacher_courses)
    @foreach ($teacher_courses as $course)
            <tr>
                <td>{{ $course->id }}</td>
                <td>{{ $course->name }}</td>
                <td>{{ $course->year }}</td>
<td>
{{ $course->department->collage->name }}
</td>
<td>
	{{ $course->department->name }}	
</td>
    <td style="display: flex;justify-content:center">
<div class="btn-group ml-3">
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    {{  __('lecture.lectures')  }}
  </button>
  <div class="dropdown-menu">
  @if (Auth::user()->user_type<5)
  <a class="dropdown-item" href="{{ route('course.lecture.index',$course->id) }}">{{ __('lecture.lectures') }}</a>
<a class="dropdown-item" href="{{ route('course.lecture.create',$course->id) }}">{{ __('lecture.add_lecture') }}</a>
@endif

  </div>
</div>
@if (Auth::user()->user_type<5)
    
<div class="btn-group ml-3" >
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
{{ __('exam.questions') }}
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="{{ route('course.question.index',$course->id) }}">{{ __('exam.questions') }}</a>
<a class="dropdown-item" href="{{ route('course.question.create',$course->id) }}">{{ __('exam.add_questions') }}</a>
  </div>
</div>

<a href="{{route('department.course.show',[$course->department->id,$course->id])}}" title="{{ trans('department.Show') }}"
                class="btn btn-warning btn-sm mr-3 ml-3"><i class="fa fa-eye"></i></a>

<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal{{ $course->id }}" data-whatever="@mdo" title="{{ __('messages.write') }}"><i class="far fa-comment"></i></button>
@endif


                </td>
            </tr>

{{-- modal to send message --}}

<div class="modal fade" id="exampleModal{{ $course->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __('messages.new_message') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('message.store') }}" method="POST">
@csrf
          <div class="form-group">
            <label for="title" class="col-form-label">{{ __('messages.title') }}</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}">
          </div>
          <div class="form-group">
            <label for="body" class="col-form-label">{{ __('messages.message') }}</label>
            <textarea class="form-control" id="body" name="body" placeholder="{{ __('messages.message') }}">{{ old('body') }}</textarea>
          </div>
<input type="hidden" name="department_id" value="{{ $course->department_id }}">
<input type="hidden" name="course_id" value="{{ $course->id }}">
<input type="hidden" name="sender" value="{{ Auth::id() }}">
<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Collages_trans.Close') }}</button>
        <button type="submit" class="btn btn-primary">{{ __('messages.send') }}</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
        @endforeach
@endif
    </table>
</div>

            </div>
        </div>
    </div>
</div>

@endsection
@section('js')

@endsection
