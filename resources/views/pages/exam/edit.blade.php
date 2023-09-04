@extends('layouts.master')
@section('css')

@section('title')
    {{ __('department.edit_department') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('department.edit_department') }}
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
                <form action="{{ route('department.update',$department->id) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="name" class="mr-sm-2">{{ __('department.name_ar') }}
                                :</label>
                            <input id="name" type="text" name="name" class="form-control" value="{{ $department->getTranslation('name', 'ar') }}">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col">
                            <label for="name_en" class="mr-sm-2">{{ __('department.name_en') }}
                                :</label>
                            <input type="text" class="form-control" name="name_en" value="{{ $department->getTranslation('name', 'en') }}">
                            @error('name_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
            <div class="row">       
 <div class="col">
                            <label for="years" class="mr-sm-2">{{ __('department.Years') }} 
                                :</label>
                            
<select name="years" class="form-control form-control-lg" aria-label="Default select example" >
<option selected disabled>{{ __('department.Choose_Years') }}</option>
    <option value="2" {{ $department->years==2?'selected':''}}>2</option>
    <option value="3"{{ $department->years==3?'selected':''}} >3</option>
    <option value="4" {{ $department->years==4?'selected':''}}>4</option>
    <option value="5" {{ $department->years==5?'selected':''}}>5</option>
    <option value="6" {{ $department->years==6?'selected':''}}>6</option>
</select>  

                            @error('years')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>


<div class="col">
        <label for="collage_id" class="mr-sm-2">{{ __('department.Collage') }}
            :</label>

<select name="collage_id" class="form-control form-control-lg" aria-label="Default select example" >
<option selected disabled>{{ __('department.Choose_collage') }}</option>
@foreach ($collages as $collage)
    <option value="{{ $collage->id }}" {{ $department->collage_id==$collage->id?'selected':''}}>{{ $collage->name }}</option>
@endforeach
</select>                            

    @error('collage_id')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
                        </div></div>
                    </div>
                   
                    <br><br>
            </div>
            <div class="modal-footer">
                <a class="btn btn-secondary" href="{{ route('department.index') }}"
                     >{{ __('department.Close') }}</a>
                <button type="submit" class="btn btn-success">
{{ __('department.submit') }}
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
