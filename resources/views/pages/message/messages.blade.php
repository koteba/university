@extends('layouts.master')
@section('css')

@section('title')
        {{ __('messages.messages') }}

@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('messages.messages') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
								
  
<br>


    <div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>#</th>
            <th>{{ trans('messages.title') }}</th>
            <th>{{ trans('messages.sender') }}</th>
            <th>{{ trans('messages.message') }}</th>
            <th>{{ trans('messages.date') }}</th>
            <th>{{ trans('Collages_trans.Processes') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($messages as $message)
            <tr> 
                <td>{{ $loop->index  }}</td>
                <td>{{ $message->title }}</td>
                <td>{{ $message->sender($message->sender_id)->name }}</td>
                <td>{{ Str::words($message->body,40,'  .....') }}</td>
                <td>{{ $message->created_at->diffForHumans() }}</td>
                <td style="display: flex;justify-content:center">

<!-- Button trigger modal -->
<button type="button" class="btn btn-warning btn-sm mr-3" data-toggle="modal" data-target="#exampleModalCenter{{ $message->id }}">
<i class="fa fa-eye"></i>
</button>
   <!-- Button trigger modal -->
<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal{{ $message->id }}">
<i class="fa fa-trash"></i>
</button>             

                </td>
            </tr>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter{{ $message->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">{{ $message->title }}</h5>
      
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> 
      </div>
      <div class="modal-body">
 <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
        <p class="alert alert-primary">{{ $message->body }}</p>
       <p>{{ $message->sender($message->sender_id)->name }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
      </div>
    </div>
  </div>
</div>


<!-- delete message Modal -->
<div class="modal fade" id="exampleModal{{ $message->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ $message->title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ __('lecture.sure') }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a type="button" class="btn btn-danger" href="{{ route('deleteMessage',$message->id) }}">{{ __('department.Delete') }}</a>
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
