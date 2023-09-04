@extends('layouts.master')
@section('css')

@section('title')
    post 
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
<a href="{{ route('post.index') }}">{{ __('post.blog') }}</a> / {{ __('post.body') }}
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
<h2 class="alert alert-warning" role="alert">{{ $post->title }}</h2>
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" >
  <div class="carousel-inner">
 @forelse($post->images as $attachment)
    <div class="carousel-item {{ $loop->first?'active':'' }}">
<a  href="{{url('Download_attachment')}}/{{$attachment->id}}"   >      
<img src="{{url('/attachments/posts/'.$attachment->filename)}}" class="d-block w-100" alt="{{url('/attachments/posts/'.$attachment->filename)}}" style="height: 30rem ">
</a>
    </div> 
  @empty

@endforelse  
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


{{--   delete attachment modal  --}}
<div class="modal fade" id="Delete_img{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
{{trans('post.delete_post')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('post.destroy',$post->id)}}" method="post">
                    @csrf
@method('DELETE')

                    <h5 style="font-family: 'Cairo', sans-serif;">
{{trans('lecture.sure')}}</h5>
                    <input type="text" name="filename" readonly value="{{$post->title}}" class="form-control">

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

<div class="alert alert-primary mt-5" role="alert">
<strong>
{{ $post->user->name }} :
</strong>
<br>
<small class=" text-muted"><small>{{ $post->created_at->diffForHumans() }}</small></small>

<div class="alert alert-info" role="alert">

{{ $post->body }}
<br>
@if (($post->user_id==Auth::id())||(Auth::user()->user_type<5))
    
<button type="button" class="btn btn-outline-danger btn-sm mt-3"
                        data-toggle="modal"
                        data-target="#Delete_img{{ $post->id }}"
                        title="{{ __('department.Delete') }}"><i class="fa fa-trash"></i>&nbsp; 
{{__('department.Delete')}}
                </button>
@endif
</div> 
</div>
<!-- row closed -->
{{--  comments  --}}
<div class="card-body border">
 @forelse ($post->comments as $comment)
<div class="alert alert-dark" role="alert">
 <bold> {{ $comment->user->name }}</bold><br>
<small class=" text-muted"><small>{{ $comment->created_at->diffForHumans() }}</small></small>
<div class="alert alert-secondary" role="alert">
  {{ $comment->body }}
@if (($comment->user_id==Auth::id())||(Auth::user()->user_type<5))

<div style="display: flex;justify-content:center">
@if ($comment->user_id==Auth::id())

<div><a href="{{ route('post.comment.edit',[$post->id,$comment->id]) }}" title="{{ trans('department.Edit') }}"  class="btn btn-primary btn-sm mr-3">
            <i class="fa fa-edit"></i>
    </a>
</div>
@endif
<div>
<form action="{{ route('post.comment.destroy',[$post->id,$comment->id]) }}" method="post" >
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
                <form action="{{ route('post.comment.store',$post->id) }}" method="POST">
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

                    </div>
                   
                    <br><br>
           
            </form>

        </div>
    


            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
