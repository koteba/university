@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.update',Auth::id()) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('auth.name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <label for="name_en" class="col-md-4 col-form-label text-md-right">{{ __('auth.name_en') }}</label>

                            <div class="col-md-6">
                                <input id="name_en" type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en" value="{{ old('name_en') }}" required autocomplete="name_en" autofocus>

                                @error('name_en')
                                    <span class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
  
                      
<div class="form-group row">
                            <label for="collage_id" class="col-md-4 col-form-label text-md-right">{{ __('student.collage') }}</label>

                            <div class="col-md-6">

<div class="input-group mb-3">
  <select name="collage_id" class="custom-select" id="collage_id" onchange="console.log($(this).val())">
    <option selected>Choose...</option>
@foreach ($collages as $collage)
                                <option value="{{ $collage->id }}">
                                {{ $collage->name }}
                                </option>
                            @endforeach
  </select>
  <div class="input-group-append">
    <label class="input-group-text" for="inputGroupSelect02">{{ __('student.collage') }}</label>
  </div>
</div>
                                @error('collage_id')
                                    <span class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="collage_id" class="col-md-4 col-form-label text-md-right">{{ __('student.department') }}</label>

                            <div class="col-md-6">
<div class="input-group mb-3">
<select name="department_id" class="custom-select" id="department_id" >
                           
                                </select>

<div class="input-group-append">
    <label class="input-group-text" for="inputGroupSelect02">{{ __('student.department') }}</label>
  </div></div>
                                @error('department_id')
                                    <span class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
 <div class="form-group row">
                            <label for="year" class="col-md-4 col-form-label text-md-right">{{ __('department.Year') }}</label>

                            <div class="col-md-6">
                                <input id="year" type="number" class="form-control @error('year') is-invalid @enderror" name="year" value="{{ old('year') }}" required autocomplete="year" autofocus>

                                @error('year')
                                    <span class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


<input type="hidden" name="user_type" value="5">
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('auth.phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
 <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('admin.photo') }}</label>

                            <div class="col-md-6">
                                <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" value="{{ old('photo') }}"  accept="image/*" autofocus>

                                @error('photo')
                                    <span class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       

               

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('auth.register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
   
<script>
$(document).ready(function () {
    $('#collage_id').on('change', function () {
        let collage_id = $(this).val();
// alert(collage_id);
            if (collage_id) {

                var url = "{{ URL::to('getDepartments') }}";
            var op=" ";
           $.ajax({
                url: '{!!URL::to('/getdepartments')!!}',
                type: "get",
                data:{collage_id:collage_id},
                success: function (response) {
     var $select = $('#department_id');

    $select.find('option').remove();
    $.each(response,function(key, value)
                {
    $select.append('<option value=' + key + '>' + value + '</option>'); // return empty
                });
                  }   }); }else {
            console.log('AJAX load did not work');
                        }
                    });
                });

 </script> 


 
@endsection