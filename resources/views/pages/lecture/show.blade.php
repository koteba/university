@extends('layouts.master')
@section('css')

@section('title')
    {{ $lecture->title }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
<a href="{{ route('department.show',$course->department->id) }}">{{ $course->department->name }}</a> / <a href="{{ route('department.course.show',[$course->department->id,$course->id]) }}">{{ $course->name }}</a> / <a href="{{ route('course.lecture.index',$course->id) }}">{{ __('lecture.lectures') }}</a> / {{ $lecture->title }}
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
        <tr >
<th class="table-success">{{ __('lecture.title') }}</th>
            <th  colspan="3">
{{  $lecture->title }}</th>
        </tr>
        </thead>
        <tbody>
<tr>
    <td width="17%" class="table-success">{{ __('lecture.notes') }}</td>
<th colspan="3">{{ $lecture->note }}</th>
</tr>
<tr class="table-success">
<th  class="bolder">#</th>
<td   class="bolder">{{ __('lecture.files') }}</td>
<td  class="bolder">{{ __('lecture.time') }}</td>
<td  class="bolder">{{ __('department.Processes') }}</td>
</tr>
@forelse($lecture->images as $attachment)
    <tr style='text-align:center;vertical-align:middle'>
        <td>{{$loop->iteration}}</td>
        <td>{{$attachment->filename}}</td>
        <td>{{$attachment->created_at->diffForHumans()}}</td>
        <td colspan="2">
        <a class="btn btn-outline-info btn-sm"
                    href="{{url('Download_attachment')}}/{{ $attachment->imageable->id }}/{{$attachment->id}}"
                    role="button"><i class="fas fa-download"></i>&nbsp;
{{__('lecture.download')}}</a>
@if (Auth::user()->user_type<5)

        <button type="button" class="btn btn-outline-danger btn-sm"
                        data-toggle="modal"
                        data-target="#Delete_img{{ $attachment->id }}"
                        title="{{ __('department.Delete') }}"><i class="fa fa-trash"></i>&nbsp;
{{__('department.Delete')}}
                </button>
@endif

        </td>
    </tr>
{{--   delete attachment modal  --}}
<div class="modal fade" id="Delete_img{{$attachment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
{{trans('lecture.delete_attachment')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('lecture_Delete_attachment',$lecture->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$attachment->id}}">

                    <h5 style="font-family: 'Cairo', sans-serif;">
{{trans('lecture.sure')}}</h5>
                    <input type="text" name="filename" readonly value="{{$attachment->filename}}" class="form-control">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
{{trans('years_trans.Close')}}</button>
                        <button  class="btn btn-danger"><i class="fa fa-trash">&nbsp; </i>
{{trans('lecture.delete')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{--   end delete attachment modal  --}}

   @empty

@endforelse
@if (Auth::user()->user_type<5)

<tr>
<td class="table-success">
{{ __('lecture.add_files') }}
</td>
<form method="post" action="{{route('lecture_Upload_attachment',$lecture->id)}}" enctype="multipart/form-data">
    {{ csrf_field() }}
<td colspan="1">


  <input type="file" id="photos" name="photos[]" class="form-control" multiple accept=".jpg,.png,.gif,.jpeg,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
</label>
</td>
<td colspan="2">
    <button type="submit" class="btn btn-outline-success ">
            {{ __('department.submit') }}
    </button>
</td>
</form>
</tr>
<tr>
 <th  colspan="4" >
<div style="display: flex;justify-content:center">
    
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm mr-3  pr-5 pl-5" title="{{ trans('department.Edit') }}" data-toggle="modal" data-target="#exampleModalE{{ $lecture->id }}">
            <i class="fa fa-edit"></i>
</button>

<!-- Button trigger modal -->
<button type="button" class="btn btn-danger btn-sm pr-5 pl-5" data-toggle="modal" data-target="#exampleModalD{{ $lecture->id }}" title="{{ trans('department.Delete') }}">
<i class="fa fa-trash"></i></button>



></div>
</th>
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
@endif

        </tbody></table>
        </div>



            </div>
        </div>
    </div>
</div>
<div class="card">
<div class="card-head"><h5 class="card-title">{{ __('comments') }}</h5></div>
{{--  comments  --}}
<div class="card-body border">
 @forelse ($lecture->comments as $comment)
<div class="alert alert-dark" role="alert">
 <bold> {{ $comment->user->name }}</bold><br>
<small class=" text-muted"><small>{{ $comment->created_at->diffForHumans() }}</small></small>
<div class="alert alert-secondary" role="alert">
  {{ $comment->body }}
@if (($comment->user_id==Auth::id())||(Auth::user()->user_type<5))

<div style="display: flex;justify-content:center">
@if ($comment->user_id==Auth::id())

<div><a href="{{ route('post.comment.edit',[$lecture->id,$comment->id]) }}" title="{{ trans('department.Edit') }}"  class="btn btn-primary btn-sm mr-3">
            <i class="fa fa-edit"></i>
    </a>
</div>
@endif
<div>
<form action="{{ route('destroyForLecture',[$course->id,$lecture->id,$comment->id]) }}" method="post" >
@method('DELETE')
@csrf
 <button type="submit" class="btn btn-danger btn-sm"  title="{{ trans('department.Delete') }}"><i class="fa fa-trash"></i></button>
</form></div>
</div>
@endif
</div>
</div>

 @empty

 @endforelse
</div>

{{--  add comment  --}}
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
              <br>
                <!-- add_form -->
                <form action="{{ route('storeForLecture',[$course->id,$lecture->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-10">

                            <input id="body" type="text" name="body" class="col-12 form-control-sm border" placeholder="{{ __('post.add_comment') }}">
                        @error('body')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
 

<div class="col">
<button type="submit" class="btn btn-success ">
{{ trans('post.comment') }}
</button>
</div></div>
                    <br><br>
            </form>
        </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection

