@extends('layouts.master')
@section('css')

@section('title')
    empty
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    user edit
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
      <form action="{{ route('user.update',$user->id) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="name" class="mr-sm-2">{{ trans('Collages_trans.stage_name_ar') }}
                                :</label>
                            <input id="name" type="text" name="name" class="form-control" value="{{ $user->getTranslation('name', 'ar') }}">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col">
                            <label for="name_en" class="mr-sm-2">{{ trans('Collages_trans.stage_name_en') }}
                                :</label>
                            <input type="text" class="form-control" name="name_en" value="{{ $user->getTranslation('name', 'en') }}">
                            @error('name_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                          
 <div class="col">
                            <label for="phone" class="mr-sm-2">phone
                                :</label>
             
 <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                            @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>

</div>

             <div class="row">
                <div class="col">
    <label for="description"
        class="mr-sm-2">collage
        :</label>
                   
<select name="collage_id" class="form-control form-control-lg"onclick="console.log($(this).val())" aria-label="Default select example" >
<option selected disabled>select collage</option>
@foreach ($collages as $collage)
        <option value="{{ $collage->id }}" {{
 $user->department->collage_id==$collage->id?'selected':''}}>{{ $collage->name }}</option>
@endforeach
</select>  

                </div>
                <div class="col">
    <label for="description_en"
        class="mr-sm-2">  department
        :</label>

                         
<select name="department_id" class="form-control form-control-lg" aria-label="Default select example" >
        <option value="{{ $user->department_id }}" selected>
{{ $user->department->name }}
</option>
</select> 

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
@section('js')
<script>
$(document).ready(function () {
    $('select[name="collage_id"]').on('change', function () {
        let collage_id = $(this).val();
            if (collage_id) {

                var url = "{{ URL::to('getDepartments') }}";
                            //alert(url);
           $.ajax({
                url: "{{ URL::to('sections') }}/" + collage_id,
                type: "GET",
                data:{collage_id:collage_id},
                dataType: "json",
                success: function (data) {
                    // alert(data);
                    $('select[name="department_id"]').empty();
                    $.each(data, function (key, value) {
                    $('select[name="department_id"]').append('<option value="' + key + '">' + value + '</option>');
                                    });
                                },
                            });
                        } else {
            console.log('AJAX load did not work');
                        }
                    });
                });

            </script>

@endsection
