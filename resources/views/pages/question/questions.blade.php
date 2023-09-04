@extends('layouts.master')
@section('css')

@section('title')
    {{ __('exam.questions') }}
@stop 
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('exam.questions') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
			               
<a class="btn btn-success btn-sm btn-lg pull-right"
 href="{{ route('course.question.create',$course->id )}}">
{{ __('exam.add_questions') }}
</a>
<br>					
                
<br>


    <div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>#</th>
            <th>{{ __('exam.question') }}</th>
<th>{{ __('exam.correct_answer') }}</th>
            <th>{{ __('exam.answer') }} 2</th>
            <th>{{ __('exam.answer') }} 3</th>
            <th>{{ __('exam.answer') }} 4</th>
            <th>{{ trans('Collages_trans.Processes') }}</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0; ?>
        @foreach ($questions as $question)
            <tr>
                <?php $i++; ?>
                <td>{{ $i }}</td>
                <td>{{ $question->question }}</td>
                <td>{{ $question->answer1 }}</td>
                <td>{{ $question->answer2 }}</td>
                <td>{{ $question->answer3 }}</td>
                <td>{{ $question->answer4 }}</td>

    <td style="display: flex;justify-content:center">
        <a href="{{ route('course.question.show',[$course->id,$question->id]) }}" title="{{ trans('department.Show') }}"
                class="btn btn-warning btn-sm mr-3"><i class="fa fa-eye"></i></a>

@if (Auth::user()->user_type<5)
    

<!-- Button trigger modal -->
<button type="button" title="{{ trans('department.Edit') }}"  class="btn btn-primary btn-sm mr-3" data-toggle="modal" data-target="#exampleModal{{ $question->id }}">
            <i class="fa fa-edit"></i>
</button>
<!-- Button trigger modal -->
<button type="button" class="btn btn-danger btn-sm"  title="{{ trans('department.Delete') }}" data-toggle="modal" data-target="#exampleModalD{{ $question->id }}">
<i class="fa fa-trash"></i></button>


@endif

                </td>
            </tr>


<!-- Modal -->
<div class="modal fade" id="exampleModal{{ $question->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __('department.Edit') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{--  **********  --}}

 <form class=" row mb-30" action="{{ route('course.question.update',[$course->id,$question->id]) }}" method="POST">
@method('PATCH')
   @csrf 
<div class="card-body">
            <div class="row">

                    <div class="col">
                    <label for="question"
                        class="mr-sm-2 bold">
{{ __('exam.question') }}
                        :</label>
                    <div class="box">
                       <textarea class="form-control" name="question" id="" cols="30" rows="4" required>{{ $question->question }}</textarea>
                    </div>
                </div>
 
 <div class="col">
    <label for="answer1"
        class="mr-sm-2">{{ __('exam.correct_answer') }}
        :</label>

                    <div class="box">
                       <textarea class="form-control" name="answer1" id="" cols="30" rows="4" required>{{ $question->answer1 }}</textarea>
                    </div>

                </div>

 
            </div>            <div class="row">

 <div class="col">
    <label for="answer2"
        class="mr-sm-2">{{ __('exam.answer') }} 2
        :</label>

                    <div class="box">
                       <textarea class="form-control" name="answer2" id="" cols="30" rows="4" required>{{ $question->answer2 }}</textarea>
                    </div>

                </div>
                <div class="col">
    <label for="answer3"
        class="mr-sm-2">{{ __('exam.answer') }} 3
        :</label>

                    <div class="box">
                       <textarea class="form-control" name="answer3" id="" cols="30" rows="4">{{ $question->answer3 }}</textarea>
                    </div>

                </div>
                <div class="col">
    <label for="answer4"
        class="mr-sm-2">  {{ __('exam.answer') }} 4
        :</label>

                    <div class="box">
                       <textarea class="form-control" name="answer4" id="" cols="30" rows="4">{{ $question->answer4 }}</textarea>
                    </div>

                </div>
</div> <div class="row">
  <div class="col">
    <label for="note"
        class="mr-sm-2">  {{ __('exam.notes') }}
        :</label>

                    <div class="box">
                       <textarea class="form-control" name="note" id="" cols="30" rows="4" required>{{ $question->note }}</textarea>
                    </div>

                </div>
            </div>


</div>
  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('department.Close') }}</button>
        <button type="sub,it" class="btn btn-primary">{{ __('department.Edit') }}</button>
      </div>
 </form>
{{--  **********  --}}
      </div>
    
    </div>
  </div>
</div>



<!-- delete Modal -->
<div class="modal fade" id="exampleModalD{{ $question->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">{{ __('exam.delete') }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<h5 >{{ $question->question }}</h5>

<form action="{{ route('course.question.destroy',[$course->id,$question->id]) }}" method="post" >
@method('DELETE')
@csrf
 <button type="" class="btn btn- btn-sm"  ></button>
 <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger" title="{{ trans('department.Delete') }}">{{ __('department.Delete') }}</button>
      </div>
</form>

      </div>
     
    </div>
  </div>
</div>
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
