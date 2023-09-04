@extends('layouts.master')
@section('css')

@section('title')
    {{ __('meeting.create_online_lesson') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('meeting.create_online_lesson') }}
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
                
<div class="container">
 <form action="{{ route('meeting.store') }}" method="POST"  >
@csrf
<div class="row">
<div class="col">
<label for="title">{{ __('exam.title') }}</label>
<input type="text" name="title" value="{{ old('title') }}" class="form-control">
</div>
<div class="col">
 <label for="course_id">{{ __('course.name') }}</label>
<select name="course_id" class="form-control p-0">
@forelse ($courses as $course)
    <option value="{{ $course->id }}">{{ $course->name }}</option>
@empty
    
@endforelse
</select>

</div>
</div>
<div class="row">
<div class="col">
 <div class="form-group">
 <label for="date">{{ __('exam.date') }}</label>
 <input id="date" type="date" name="date" class="form-control">
 </div>
</div>

<div class="col">
 <div class="form-group">
 <label for="time">{{ __('exam.time') }}</label>
 <input id="time" type="time" name="time" class="form-control">
 </div>
</div>


</div>

 <button class="btn btn-success" type="submit">{{ __('meeting.create_online_lesson') }}</button>
 </form>
</div>

        </div>
    


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection

