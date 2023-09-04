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
 <form class=" row mb-30" action="{{ route('course.lecture.store',$course->id) }}" method="POST" enctype="multipart/form-data">
   @csrf 
<div class="card-body">
<div class="repeater">
    <div data-repeater-list="lectures">
        <div data-repeater-item style="border-bottom: rgba(165, 9, 9, 0.267) 1px dashed;" class="mb-3">
            <div class="row">

                    <div class="col">
                    <label for="title"
                        class="mr-sm-2 bold">
{{ __('exam.title') }}
                        :</label>
                    <div class="box">
                       <textarea class="form-control" name="title" id="" cols="30" rows="4">{{ old('title') }}</textarea>
                    </div>
                </div>

 <div class="col">
    <label for="note"
        class="mr-sm-2">{{ __('exam.notes') }}
        :</label>

                    <div class="box">
                       <textarea class="form-control" name="note" id="" cols="30" rows="4">{{ old('note') }}</textarea>
                    </div>

                </div>

 

 <div class="col">
    <label for="files"
        class="mr-sm-2">{{ __('lecture.files') }} 
        :</label>
                    <div class="box">
                       <input type="file" name="files" multiple id="files" accept="image/*,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.pdf">
                    </div>
@if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        {{--  <img src="uploads/{{ Session::get('file') }}">  --}}
        @endif

                </div>
                
                
</div> 
        </div>
    </div>
    <div class="row mt-20">
        <div class="col-12">
            <input class="button" data-repeater-create type="button" value="{{ trans('My_sections_trans.add_row') }}"/>
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary"
            data-dismiss="modal">{{ trans('Collages_trans.Close') }}</button>
        <button type="submit"
            class="btn btn-success">{{ trans('Collages_trans.submit') }}</button>
    </div>


</div>
</div>
   </form>
 </div>


</div>
<!-- row closed -->
@endsection
