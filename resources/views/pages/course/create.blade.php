@extends('layouts.master')
@section('css')

@section('title')
    {{ __('course.Add_course') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('course.Add_course') }}

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
                        class="mr-sm-2">{{ __('course.name_ar') }}
                        :</label>
                    <input class="form-control" type="text" name="name" required/>
                </div>

    <div class="col">
        <label for="name_en"
            class="mr-sm-2">{{ __('course.name_en') }}
            :</label>
        <input class="form-control" type="text" name="name_en" required/>
    </div>

 <div class="col">
    <label for="year" class="mr-sm-2">{{ __('department.Year') }}
        :</label>
                            
<select name="year" class="form-control form-control-lg" aria-label="Default select example" >
<option selected disabled>{{ __('department.Year') }}</option>
@for ($i = 1; $i <= $department->years; $i++)
        <option value="{{ $i }}" >{{ $i }}</option>
@endfor
</select>  

            @error('year')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
                         </div>

 <div class="col">
    <label for="season" class="mr-sm-2">{{ __('course.season') }}
        :</label>
                            
<select name="season" class="form-control form-control-lg" aria-label="Default select example" >
<option selected value="1">{{ __('course.first_season') }}</option>
<option  value="2">{{ __('course.second_season') }}</option>
</select>  

            @error('season')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
                        </div>
            </div>           

 <div class="row">
                <div class="col">
    <label for="description"
        class="mr-sm-2">{{ __('course.description') }}
        :</label>

                    <div class="box">
                       <textarea class="form-control" name="description" id="" cols="30" rows="4"></textarea>
                    </div>

                </div>
                <div class="col">
    <label for="description_en"
        class="mr-sm-2">  {{ __('course.description_en') }}
        :</label>

                    <div class="box">
                       <textarea class="form-control" name="description_en" id="" cols="30" rows="4"></textarea>
                    </div>

                </div>
@if (Auth::user()->user_type == 1)
<div class="col">
    <label for="department_id" class="mr-sm-2"> {{ __('department.department') }}
        :</label>
                            
<select name="department_id" class="form-control form-control-lg" aria-label="Default select example" >
<option selected disabled value="0">{{ __('department.department') }}</option>
@forelse ($departments as $department)
           <option value="{{ $department->id }}" > {{ $department->name }} </option> 
@empty
    <option disabled>{{ __('course.no_departments') }}</option>
@endforelse
</select>  

            @error('department')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
                        </div>
@else
    <input type="hidden" name="department_id" value="{{ $department->id }}">
@endif

 
 <div class="col">
    <label for="teacher" class="mr-sm-2">{{ __('admin.teacher') }}
        :</label>
                            
<select name="teacher" class="form-control form-control-lg" aria-label="Default select example" >
<option selected disabled value="0">{{ __('admin.teacher') }}</option>
@forelse ($users as $user)
        @if ((Auth::user()->user_type==2 && (Auth::user()->department_id == $user->department_id))||Auth::user()->user_type==1)
                       <option value="{{ $user->id }}" > {{ $user->name }} </option> 
        @endif
        
@empty
    <option disabled>{{ __('course.no_teachers') }}</option>
@endforelse
</select>  

            @error('teacher')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
                        </div>
 <div class="col">
    <label for="teacher2" class="mr-sm-2">{{ __('admin.teacher2') }}
        :</label>
                            
<select name="teacher2" class="form-control form-control-lg" aria-label="Default select example" >
<option selected disabled value="0">{{ __('admin.teacher2') }}</option>
@forelse ($users as $user)
        @if ((Auth::user()->user_type==2 && (Auth::user()->department_id == $user->department_id))||Auth::user()->user_type==1)
           <option value="{{ $user->id }}" >{{ $user->name }}</option> 
@endif
@empty
    <option disabled>{{ __('course.no_teachers') }}</option>
@endforelse
</select>  

            @error('teacher2')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
                        </div>
                <div class="col">
                    <label 
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
