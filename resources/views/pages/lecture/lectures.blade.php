@extends('layouts.master')
@section('css')

@section('title')
    {{ $course->name }}
@stop 
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
 <a href="{{ route('department.show',$course->department->id) }}">{{ $course->department->name }}</a> / <a href="{{ route('department.course.show',[$course->department->id,$course->id]) }}">{{ $course->name }}</a> / {{ __('lecture.lectures') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
	@if (Auth::user()->user_type<5)
		               
<a class="btn btn-success btn-sm btn-lg pull-right"
 href="{{ route('course.lecture.create',$course->id )}}">
{{ __('lecture.add_lecture') }}
</a>
@endif

<br>					
                
<br>


    <div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>#</th>
            <th>{{ __('lecture.title') }}</th>
<th>{{ __('lecture.notes') }}</th>
            <th>{{ __('lecture.files') }}</th>
            <th>{{ trans('Collages_trans.Processes') }}</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0; ?>
        @foreach ($lectures as $lecture)
            <tr>
                <?php $i++; ?>
                <td>{{ $i }}</td>
                <td>{{ $lecture->title }}</td>
                <td>
{{ Str::words($lecture->note,40,'  .....') }}
</td>
                <td>{{ $lecture->images->count() }}</td>


    <td style="display: flex;justify-content:center">
        <a href="{{ route('course.lecture.show',[$course->id,$lecture->id]) }}" title="{{ trans('department.Show') }}"
                class="btn btn-warning btn-sm mr-3"><i class="fa fa-eye"></i></a>

@if (Auth::user()->user_type<5)
    
    
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary  btn-sm mr-3" title="{{ trans('department.Edit') }}" data-toggle="modal" data-target="#exampleModalE{{ $lecture->id }}">
            <i class="fa fa-edit"></i>
</button>
<!-- Button trigger modal -->
<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalD{{ $lecture->id }}" title="{{ trans('department.Delete') }}">
<i class="fa fa-trash"></i></button>

@endif

                </td>
            </tr>


<!-- Modal -->
<div class="modal fade" id="exampleModalE{{ $lecture->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __('department.Edit') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

 <form  action="{{ route('course.lecture.update',[$course->id,$lecture->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col">
                            
                            <input id="title" type="text" name="title" class="col-12 form-control-sm border" placeholder="{{ __('exam.title') }}" value="{{ $lecture->title }}">
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
</div>
 <div class="row" >

                        <div class="col mt-3">
                            
<textarea name="note" id="note" cols="70" rows="3" placeholder="{{ __('exam.notes') }}" class="form-control border">{{ $lecture->note }}</textarea>
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

</div>

                    </div>
                   
                    <br><br>
           <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">{{ __('department.Edit') }}</button>
      </div>
            </form>      </div>
      
    </div>
  </div>
</div>



<!-- delete Modal -->
<div class="modal fade" id="exampleModalD{{ $lecture->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __('lecture.delete') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ $lecture->title }}

 <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('department.Close') }}</button>
<form action="{{ route('course.lecture.destroy',[$course->id,$lecture->id]) }}" method="post" >
@method('DELETE')
@csrf
 <button type="submit" class="btn btn-danger "  title="{{ trans('department.Delete') }}">{{ __('lecture.delete') }}</button>
</form>
      </div>
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
