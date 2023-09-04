@extends('layouts.master')
@section('css')

@section('title')
    {{ __('course.importMarks') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('course.importMarks') }}
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
<div class="row"> 
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                
<div class="container">
 <form action="{{ route('import_mark') }}" method="POST"  enctype="multipart/form-data">
@csrf
 <div class="form-group">
 <label for="file">File:</label>
 <input id="file" type="file" name="file" class="form-control">
 </div>
 
 <button class="btn btn-success">upload File</button>
 </form>
</div>

        </div>
    


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection

