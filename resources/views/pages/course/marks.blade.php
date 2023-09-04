@extends('layouts.master')
@section('css')

@section('title')
    {{ __('course.marks') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('course.marks') }}

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
 <form class=" row mb-30" action="{{ route('check-mark') }}" method="POST">
   @csrf
<div class="card-body">         

 <div class="row">

 <div class="col-6">
    <label for="course" class="mr-sm-2">{{ __('teacher.Course') }}
        :</label>
                            
<select name="course_id" class="form-control form-control-lg" aria-label="Default select example" >
<option selected disabled value="0">{{ __('teacher.Course') }}</option>
@forelse ($courses as $course)
           <option value="{{ $course->id }}" > {{ $course->name }} </option> 
@empty
    <option disabled>{{ __('course.error') }}</option>
@endforelse
</select>  

            @error('course')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
                        </div>

            </div>
    <div class="row">

                <div class="col">
                    <button class="btn btn-primary">Check</button>
                </div></div>


</div>
   </form>
 </div>

@if ($mark)
<div class="alert alert-{{ $mark->mark>=60?'success':'danger' }}" role="alert">
  <strong>{{ $mark->course->name }} : {{ $mark->mark }}</strong>
</div>
    
@endif

</div>
<!-- row closed -->
@endsection
