@extends('layouts.master')
@section('css')

@section('title')
    {{ __('post.blog') }}
@stop 
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('post.blog') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
 @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

{{--  ***************  --}}
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
              <br>
                <!-- add_form -->
                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            
                            <input id="title" type="text" name="title" class="col-12 form-control-sm border" placeholder="{{ __('lecture.title') }}">
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div></div>
 <div class="row" >

                        <div class="col mt-3">
                            
<textarea name="body" id="body" cols="70" rows="3" placeholder="{{ __('post.write_a_post') }}" class="form-control border"></textarea>
                            @error('body')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        </div>
<div class="col-3 form-control" style="display: flex; justify-content: space-around;" >
<label class="btn btn-default btn-sm center-block btn-file" style="position: relative;">
  <i class="fa fa-upload fa-2x" aria-hidden="true" style="position: absolute;top:50%;left:50%;    transform: translate(-50%, -50%);" ></i>
  <input type="file" id="photos" name="photos[]" style="display:none ;" multiple accept=".jpg,.png,.gif,.jpeg">
<span id="xx"></span>
</label>

<button type="submit" class="btn btn-success mt-3 mb-3">
{{ trans('post.post') }}
</button>
</div>

                    </div>
                   
                    <br><br>
           
            </form>

        </div>
    


            </div>
        </div>
    </div>
{{--  ***************  --}}

 <div class="row" >
@foreach ($posts as $post)
@if($post->user->department->id == Auth::user()->department->id)
                <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
                    <div  class="card card-statistics h-100" >
 
                        <div class="card-body" style="position: relative;min-height:200px; {{$post->images->count()>0? 'background-image:
linear-gradient(rgba(255, 255, 255, 0.771), rgba(255, 255, 255, 0.871)), url('.url('/attachments/posts/'.$post->images->first()->filename).');background-size:cover;background-position:center;  ':''}} ">
                            <div class="clearfix" >
                                <div class="float-left">
                                    <span class="text-danger">
                       <a href="{{ route('post.show',$post->id) }}">
@if ($post->images->count()==1)
                                    <i class="far fa-image highlight-icon" aria-hidden="true"></i>
                                    @elseif ($post->images->count()>1)
                                <i class="far fa-images highlight-icon" aria-hidden="true"></i>                                       
                                    @endif
                       </a>
                                    </span>
                                </div>
                                <div class="float-right text-right" style=" word-wrap: break-word;over-flow:hidden">
      <a href="{{ route('post.show',$post->id) }}">
 <h4 class="card-text text-dark" style="position: absolute; top:10%;left:10%">{{ $post->title }}</h4>
      </a>
                                    <p style="position: absolute;top:30%;left:10%; "> <span style="word-wrap: break-word">{{ Str::words($post->body,40,'  .....') }}</span>          

</p>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top" style="position: absolute;bottom:4px">
                                <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i> {{$post->user->name}}
                            </p>
                        </div>
                    </div>
                </div>
@endif
@endforeach
                
            </div> 
<!-- row closed -->
@endsection
@section('js')
<script>
$(document).ready(function () {
$('#photos').on('change', function () {
var num_of_images = $("#photos")[0].files.length;
var paragraph = document.getElementById("xx");

paragraph.textContent = "("+num_of_images+") file(s) selected";});
});
</script>
@endsection
