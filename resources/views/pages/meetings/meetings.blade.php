@extends('layouts.master')
@section('css')

@section('title')
        {{ __('main_trans.Onlineclasses') }}

@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.Onlineclasses') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
								
  <a  href="{{route('Download_zoom')}}"   class="btn btn-primary" alt="windows">
<i class="fab fa-windows"></i>&nbsp; {{ __('meeting.download_zoom') }}   
  </a>

<a href="https://m.apkpure.com/ar/zoom-cloud-meetings/us.zoom.videomeetings/download?from=details" class="btn btn-success" alt="android" target="_blank"><i class="fab fa-android"></i>&nbsp; {{ __('meeting.download_zoom') }}</a>

@if (Auth::user()->user_type < 5)
@if (!$old)
    <a  href="{{route('old_meetings')}}"   class="btn btn-warning" alt="windows">
 {{ __('meeting.old_meetings') }}   
  </a> 
@else
    <a  href="{{route('meeting.index')}}"   class="btn btn-warning" alt="windows">
 {{ __('meeting.back') }}   
  </a> 
@endif
    
@endif
<br>


    <div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>#</th>
            <th>{{ trans('messages.title') }}</th>
            <th>{{ trans('meeting.teacher') }}</th>
            <th>{{ trans('course.name') }}</th>
            <th>{{ trans('messages.date') }}</th>
            <th>{{ trans('meeting.url') }}</th>
            <th>{{ trans('meeting.code') }}</th>
@if (Auth::user()->user_type < 5)
            <th>{{ trans('Collages_trans.Processes') }}</th>
@endif
        </tr>
        </thead>
        <tbody>
        @foreach ($meetings as $meeting)
            <tr>
              @if ($old && $meeting->date < $date)
                       <td>{{ $loop->index  }}</td>
                <td>{{ $meeting->title }}</td>
                <td>{{ $meeting->user->name }}</td>
                <td>{{ $meeting->course->name }}</td>
                <td>{{ $meeting->date }}</td>
<td>&nbsp;
@if ($meeting->url)
       <a href="{{ $meeting->url }}"  class="btn btn-success"><i class="fas fa-sign-in-alt"></i>&nbsp;{{ __('meeting.join') }}</a>
@endif
 </td>
<td>&nbsp;
@if ($meeting->join)
      <strong>{{ $meeting->join }}</strong>
@endif
 </td>
             
@if (Auth::user()->user_type < 5)

                <td style="display: flex;justify-content:center">
    
<!-- Button trigger modal -->
<button type="button" class="btn btn-warning btn-sm mr-3" data-toggle="modal" data-target="#exampleModalCenter{{ $meeting->id }}">
<i class="fa fa-edit"></i>
</button>
   <!-- Button trigger modal -->
<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal{{ $meeting->id }}">
<i class="fa fa-trash"></i>
</button>             

                </td>
@endif
            </tr>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter{{ $meeting->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">{{ $meeting->title }}</h5>
      
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> 
      </div>
      <div class="modal-body">
<form action="{{ route('meeting.update',$meeting->id) }}" method="POST"  >
@csrf
@method('PATCH')
<div class="row">
<div class="col">
<label for="title">{{ __('exam.title') }}</label>
<input type="text" name="title" value="{{ $meeting->title }}" class="form-control">
</div>
<div class="col">
 <div class="form-group">
 <label for="course_id">{{ __('course.name') }}</label>
<select name="course_id" class="form-control p-0">
@forelse ($courses as $course)
    <option value="{{ $course->id }}" {{ $meeting->course_id==$course->id?'selected':'' }} >{{ $course->name }}</option>
@empty
    
@endforelse
</select>

 </div>
</div>
</div>
<div class="row">
<div class="col">
 <div class="form-group">
 <label for="date">{{ __('exam.date') }}</label>
 <input id="date" type="date" name="date" class="form-control" value="{{ $meeting->date }}">
 </div>
</div>
<div class="col">
 <div class="form-group">
 <label for="time">{{ __('exam.time') }}</label>
 <input id="time" type="time" name="time" class="form-control" value="{{ $meeting->time }}">
 </div>
</div>
</div>
<div class="row">

<div class="col">
<div class="form-group">
 <label for="url">{{ __('meeting.url') }}</label>
 <input id="url" type="text" name="url" class="form-control border border-danger text-danger" value="{{ $meeting->url }}">
 </div>
</div></div>
<div class="row">

<div class="col">
<div class="form-group">
 <label for="join">{{ __('meeting.code') }}</label> 
 <input id="join" type="text" name="join" class="form-control border border-danger text-danger" value="{{ $meeting->join }}">
 </div>
</div>

</div>
 <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 <button class="btn btn-success" type="submit">{{ __('meeting.edit_online_lesson') }}</button>
      </div>
 </form>
      </div>
     
    </div>
  </div>
</div>


<!-- delete message Modal -->
<div class="modal fade" id="exampleModal{{ $meeting->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ $meeting->title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ __('lecture.sure') }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<form action="{{ route('meeting.destroy',$meeting->id) }}" method="POST">
@csrf
@method('DELETE')
<input type="submit" class="btn btn-danger" value="{{ __('department.Delete') }}">
</form>
      </div>
    </div>
  </div>
</div>

              @elseif (!$old && $meeting->date >= $date)
                       <td>{{ $loop->index  }}</td>
                <td>{{ $meeting->title }}</td>
                <td>{{ $meeting->user->name }}</td>
                <td>{{ $meeting->course->name }}</td>
                <td>{{ $meeting->date }}</td>
<td>&nbsp;
@if ($meeting->url)
       <a href="{{ $meeting->url }}"  class="btn btn-success"><i class="fas fa-sign-in-alt"></i>&nbsp;{{ __('meeting.join') }}</a>
@endif
 </td>
<td>&nbsp;
@if ($meeting->join)
      <strong>{{ $meeting->join }}</strong>
@endif
 </td>

@if (Auth::user()->user_type < 5)
     <td style="display: flex;justify-content:center">

<!-- Button trigger modal -->
<button type="button" class="btn btn-warning btn-sm mr-3" data-toggle="modal" data-target="#exampleModalCenter{{ $meeting->id }}">
<i class="fa fa-edit"></i>
</button>
   <!-- Button trigger modal -->
<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal2{{ $meeting->id }}">
<i class="fa fa-trash"></i>
</button>             

                </td>
@endif
               
            </tr>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter{{ $meeting->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">{{ $meeting->title }}</h5>
      
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> 
      </div>
      <div class="modal-body">
<form action="{{ route('meeting.update',$meeting->id) }}" method="POST"  >
@csrf
@method('PATCH')
<div class="row">
<div class="col">
<label for="title">{{ __('exam.title') }}</label>
<input type="text" name="title" value="{{ $meeting->title }}" class="form-control">
</div>
<div class="col">
 <div class="form-group">
 <label for="course_id">{{ __('course.name') }}</label>
<select name="course_id" class="form-control p-0">
@forelse ($courses as $course)
    <option value="{{ $course->id }}" {{ $meeting->course_id==$course->id?'selected':'' }} >{{ $course->name }}</option>
@empty
    
@endforelse
</select>

 </div>
</div>
</div>
<div class="row">
<div class="col">
 <div class="form-group">
 <label for="date">{{ __('exam.date') }}</label>
 <input id="date" type="date" name="date" class="form-control" value="{{ $meeting->date }}">
 </div>
</div>
<div class="col">
 <div class="form-group">
 <label for="time">{{ __('exam.time') }}</label>
 <input id="time" type="time" name="time" class="form-control" value="{{ $meeting->time }}">
 </div>
</div>
</div><div class="row">

<div class="col">
<div class="form-group">
 <label for="url">{{ __('meeting.url') }}</label>
 <input id="url" type="text" name="url" class="form-control border border-danger text-danger" value="{{ $meeting->url }}">
 </div>
</div></div>
<div class="row">

<div class="col">
<div class="form-group">
 <label for="join">{{ __('meeting.code') }}</label> 
 <input id="join" type="text" name="join" class="form-control border border-danger text-danger" value="{{ $meeting->join }}">
 </div>
</div>

</div>
 <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 <button class="btn btn-success" type="submit">{{ __('meeting.edit_online_lesson') }}</button>
      </div>
 </form>
      </div>
     
    </div>
  </div>
</div>


<!-- delete  Modal -->
<div class="modal fade" id="exampleModal2{{ $meeting->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ $meeting->title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ __('lecture.sure') }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<form action="{{ route('meeting.destroy',$meeting->id) }}" method="POST">
@csrf
@method('DELETE')
<input type="submit" class="btn btn-danger" value="{{ __('department.Delete') }}">
</form>      </div>
    </div>
  </div>
</div>
              @endif
           
        @endforeach
    </table>
</div>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->




@endsection
@section('js')

@endsection
