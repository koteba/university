@extends('layouts.master')
@section('css')

@section('title')
    {{ __('department.add_department') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('department.add_department') }}
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
 <form class=" row mb-30" action="{{ route('department.store') }}" method="POST">
   @csrf
<div class="card-body">
<div class="repeater">
    <div data-repeater-list="departments">
        <div data-repeater-item>
            <div class="row">

                    <div class="col">
                    <label for="name"
                        class="mr-sm-2">{{ __('department.name_ar') }}
                        :</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name') }}" required/>
                </div>


    <div class="col">
        <label for="name_en"
            class="mr-sm-2">{{ __('department.name_en') }}
            :</label>
        <input class="form-control" type="text" name="name_en" value="{{ old('name_en') }}" required/>
    </div>

 <div class="col">
    <label for="years" class="mr-sm-2">{{ __('department.Years') }} 
        :</label>
                            
<select name="years" class="form-control form-control-lg" aria-label="Default select example" >
<option selected disabled>{{ __('department.Choose_Years') }}</option>
    <option value="2" >2</option>
    <option value="3" >3</option>
    <option value="4" >4</option>
    <option value="5" >5</option>
    <option value="6" >6</option>
</select>  

                            @error('years')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>

                <div class="col">
                    <label for="Collage_id"
                        class="mr-sm-2">{{ trans('My_sections_trans.Name_Collage') }}
                        :</label>

                    <div class="box">
                       <select name="collage_id" class="form-control form-control-lg" aria-label="Default select example" >
<option selected disabled>{{ __('department.Choose_collage') }}</option>
@foreach ($collages as $collage)
    <option value="{{ $collage->id }}" >{{ $collage->name }}</option>
@endforeach
</select> 
                    </div>

                </div>

                <div class="col">
                    <label for="Name_en"
                        class="mr-sm-2">{{ trans('My_sections_trans.Processes') }}
                        :</label>
                    <input class="btn btn-danger btn-block" data-repeater-delete
                        type="button" value="{{ trans('My_sections_trans.delete_row') }}" />
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-20">
        <div class="col-12">
            <input class="button" data-repeater-create type="button" value="{{ trans('My_sections_trans.add_row') }}"/>
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary"
            data-dismiss="modal">{{ trans('Collages_trans.Close') }}</button>
        <button type="submit"
            class="btn btn-success">{{ trans('Collages_trans.submit') }}</button>
    </div>


</div>
</div>
   </form>
 </div>













<!-- row -->

{{-- <div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
              <br>
            <div class="card-body">
                <!-- add_form -->
                <form action="{{ route('department.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="Name" class="mr-sm-2">{{ trans('My_sections_trans.Name_section') }}
                                :</label>
                            <input id="Name" type="text" name="name" class="form-control">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col">
                            <label for="name_en" class="mr-sm-2">{{ trans('My_sections_trans.Name_section_en') }}
                                :</label>
                            <input type="text" class="form-control" name="name_en">
                            @error('name_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>


 <div class="col">
                            <label for="years" class="mr-sm-2">عدد السنوات
                                :</label>
                            
<select name="years" class="form-control form-control-lg" aria-label="Default select example" >
<option selected>select years</option>
    <option value="2" >2</option>
    <option value="3" >3</option>
    <option value="4" >4</option>
    <option value="5" >5</option>
    <option value="6" >6</option>
</select>  

                            @error('years')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>


<div class="col">
                            <label for="collage_id" class="mr-sm-2">{{ trans('main_trans.Collages') }}
                                :</label>

<select name="collage_id" class="form-control form-control-lg" aria-label="Default select example" >
<option selected>select a collage</option>
@foreach ($collages as $collage)
    <option value="{{ $collage->id }}" >{{ $collage->name }}</option>
@endforeach
</select>                            

                            @error('collage_id')
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
{{ trans('My_sections_trans.submit') }}
</button>
            </div>
            </form>

        </div>
    


            </div>
        </div>
    </div> --}}
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
