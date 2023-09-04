@extends('layouts.master')
@section('css')

@section('title')
    {{ __('Collages_trans.add_Collage') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('Collages_trans.add_Collage') }}
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
            <div class="card-body">
                <!-- add_form -->
                <form action="{{ route('collage.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="Name" class="mr-sm-2">{{ trans('Collages_trans.stage_name_ar') }}
                                :</label>
                            <input id="Name" type="text" name="name" class="form-control">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col">
                            <label for="Name_en" class="mr-sm-2">{{ trans('Collages_trans.stage_name_en') }}
                                :</label>
                            <input type="text" class="form-control" name="name_en">
                            @error('name_en')
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
@section('js')

@endsection
