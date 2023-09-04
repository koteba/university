@extends('layouts.master')
@section('css')

@section('title')
    {{ __('exam.enter_exam') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('exam.enter_exam') }}
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
              <br>
            <div class="card-body">
                <!-- add_form -->
                <form action="{{ route('exaam') }}" method="post">
                    @csrf
                    <div class="row">
                       
                        <div class="col-8">
                            <label for="code" class="mr-sm-2">{{ trans('exam.code') }}
                                :</label>
                            <input type="text" class="form-control" name="code">
                            @error('code')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                  

                    </div>
                   
                    <br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                     >{{ trans('Collages_trans.Close') }}</button>
                <button type="submit" class="btn btn-success">
{{ trans('Collages_trans.submit') }}
</button>
            </div>
            </form>

        </div>
    


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
