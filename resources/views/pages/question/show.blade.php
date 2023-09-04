@extends('layouts.master')
@section('css')

@section('title')
    {{ __('exam.question_show') }} 
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('exam.question_show') }} / <a href="{{ route('department.course.show',[$course->department->id,$course->id]) }}">{{ $course->name }}</a> / <a href="{{ route('department.show',$course->department->id) }}">{{ $course->department->name }}</a> 
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
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
              <br>
            <div class="card-body">
                <!-- add_form -->
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th class="bolder" colspan="2">
{{  $question->question }}</th>
        </tr>
        </thead>
        <tbody>
<tr>
    <td width="25%">{{ __('exam.correct_answer') }}</td>
<th>{{ $question->answer1 }}</th>
</tr>
<tr>
<td>{{ __('exam.answer') }} 2</td>
<th>{{ $question->answer2 }}</th>
</tr>
@if ($question->answer3)
  <tr>
<td>{{ __('exam.answer') }} 3</td>
<th>{{ $question->answer3 }}</th>
</tr>  
@endif
@if ($question->answer4)
  <tr>
<td>{{ __('exam.answer') }} 4</td>
<th>{{ $question->answer4 }}</th>
</tr>  
@endif
<tr>
 <th  colspan="2" >
<div style="display: flex;justify-content:center">

<a href="{{ route('course.question.edit',[$question->course->id,$question->id]) }}" title="{{ trans('department.Edit') }}"
                            class="btn btn-primary btn-sm mr-3  pr-5 pl-5"><i class="fa fa-edit"></i></a>


<form action="{{ route('course.question.destroy',[$course->id,$question->id]) }}" method="post" >
@method('DELETE')
@csrf
 <button type="submit" class="btn btn-danger btn-sm pr-5 pl-5"  title="{{ trans('department.Delete') }}"><i class="fa fa-trash"></i></button>
</form></div>
</th>
</tr>
        </tbody></table>
        </div>
    


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
