@extends('layouts.master')
@section('css')

@section('title')
    empty
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    add Department
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
 <form class=" row mb-30" action="{{ route('department.course.store',$department->id) }}" method="POST">
   @csrf
<div class="card-body">
<div class="repeater">
    <div data-repeater-list="courses">
        <div data-repeater-item style="border-bottom: rgba(165, 9, 9, 0.267) 1px dashed;" class="mb-3">
            <div class="row">

                    <div class="col">
                    <label for="name"
                        class="mr-sm-2">{{ trans('My_sections_trans.Name_section') }}
                        :</label>
                    <input class="form-control" type="text" name="name" required/>
<input type="hidden" name="department_id" value="{{ $department->id }}">
                </div>


    <div class="col">
        <label for="name_en"
            class="mr-sm-2">{{ trans('My_sections_trans.Name_section_en') }}
            :</label>
        <input class="form-control" type="text" name="name_en" required/>
    </div>

 <div class="col">
    <label for="year" class="mr-sm-2">السنة
        :</label>
                            
<select name="year" class="form-control form-control-lg" aria-label="Default select example" >
<option selected class="disable">select year</option>
@for ($i = 1; $i <= $department->years; $i++)
        <option value="{{ $i }}" >{{ $i }}</option>
@endfor
</select>  

            @error('year')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
                        </div>
            </div>            <div class="row">
                <div class="col">
    <label for="description"
        class="mr-sm-2">الوصف
        :</label>

                    <div class="box">
                       <textarea class="form-control" name="description" id="" cols="30" rows="4"></textarea>
                    </div>

                </div>
                <div class="col">
    <label for="description_en"
        class="mr-sm-2"> الوصف بالانكليزي
        :</label>

                    <div class="box">
                       <textarea class="form-control" name="description_en" id="" cols="30" rows="4"></textarea>
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


</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
