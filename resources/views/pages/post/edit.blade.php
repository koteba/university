@extends('layouts.master')
@section('css')

@section('title')
    {{ __('course.edit') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('course.edit') }}
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
                <form action="{{ route('department.course.update',[$department->id,$course->id]) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="name" class="mr-sm-2">{{ trans('Collages_trans.stage_name_ar') }}
                                :</label>
                            <input id="name" type="text" name="name" class="form-control" value="{{ $course->getTranslation('name', 'ar') }}">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col">
                            <label for="name_en" class="mr-sm-2">{{ trans('Collages_trans.stage_name_en') }}
                                :</label>
                            <input type="text" class="form-control" name="name_en" value="{{ $course->getTranslation('name', 'en') }}">
                            @error('name_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                          
 <div class="col">
                            <label for="year" class="mr-sm-2">{{ __('department.Year') }}
                                :</label>
                            
<select name="year" class="form-control form-control-lg" aria-label="Default select example" >
<option selected disabled>{{ __('department.Choose_Years') }}</option>
    <option value="2" {{ $course->year==1?'selected':''}}>1</option>
    <option value="2" {{ $course->year==2?'selected':''}}>2</option>
    <option value="3"{{ $course->year==3?'selected':''}} >3</option>
    <option value="4" {{ $course->year==4?'selected':''}}>4</option>
    <option value="5" {{ $course->year==5?'selected':''}}>5</option>
    <option value="6" {{ $course->year==6?'selected':''}}>6</option>
</select>  

                            @error('year')
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
                       <textarea class="form-control" name="description" id="" cols="30" rows="4">{{ $course->getTranslation('description', 'ar') }}</textarea>
                    </div>

                </div>
                <div class="col">
    <label for="description_en"
        class="mr-sm-2"> {{ __('course.description_en') }}
        :</label>

                    <div class="box">
                       <textarea class="form-control" name="description_en" id="" cols="30" rows="4">{{ $course->getTranslation('description', 'en') }}</textarea>
                    </div>

                </div>
                    </div>
                   
                    <br><br>
            </div>
            <div class="modal-footer">
                <a class="btn btn-secondary" href="{{ route('collage.index') }}"
                     >{{ trans('Collages_trans.Close') }}</a>
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

