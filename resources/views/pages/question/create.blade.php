@extends('layouts.master')
@section('css')

@section('title')
    {{ __('exam.add_questions') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('exam.add_questions') }}
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
 <form class=" row mb-30" action="{{ route('course.question.store',$course->id) }}" method="POST">
   @csrf 
<div class="card-body">
<div class="repeater">
    <div data-repeater-list="questions">
        <div data-repeater-item style="border-bottom: rgba(165, 9, 9, 0.267) 1px dashed;" class="mb-3">
            <div class="row">

                    <div class="col">
                    <label for="question"
                        class="mr-sm-2 bold">
{{ __('exam.question') }}
                        :</label>
                    <div class="box">
                       <textarea class="form-control" name="question" id="" cols="30" rows="4"></textarea>
                    </div>
                </div>
 
 <div class="col">
    <label for="answer1"
        class="mr-sm-2">{{ __('exam.correct_answer') }}
        :</label>

                    <div class="box">
                       <textarea class="form-control" name="answer1" id="" cols="30" rows="4"></textarea>
                    </div>

                </div>

 
            </div>            <div class="row">

 <div class="col">
    <label for="answer2"
        class="mr-sm-2">{{ __('exam.answer') }} 2
        :</label>

                    <div class="box">
                       <textarea class="form-control" name="answer2" id="" cols="30" rows="4"></textarea>
                    </div>

                </div>
                <div class="col">
    <label for="answer3"
        class="mr-sm-2">{{ __('exam.answer') }} 3
        :</label>

                    <div class="box">
                       <textarea class="form-control" name="answer3" id="" cols="30" rows="4"></textarea>
                    </div>

                </div>
                <div class="col">
    <label for="answer4"
        class="mr-sm-2">  {{ __('exam.answer') }} 4
        :</label>

                    <div class="box">
                       <textarea class="form-control" name="answer4" id="" cols="30" rows="4"></textarea>
                    </div>

                </div>
</div> <div class="row">
  <div class="col">
    <label for="note"
        class="mr-sm-2">  {{ __('exam.notes') }}
        :</label>

                    <div class="box">
                       <textarea class="form-control" name="note" id="" cols="30" rows="4"></textarea>
                    </div>

                </div>
 


 <div class="col-4">
                    <label for="Name_en"
                        class="mr-sm-2">{{ trans('My_sections_trans.Processes') }}
                        :</label>
                    <input class="btn btn-danger btn-block" data-repeater-delete
                        type="button" value="{{ trans('My_sections_trans.delete_row') }}" />
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
