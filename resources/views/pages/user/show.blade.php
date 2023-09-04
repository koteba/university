@extends('layouts.master')
@section('css')

@section('title')
    {{ $user->name }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ $user->name }}
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
    <div class="col-md-12 mb-30">
        <div class="card bg-light border-dark" style="width: 50%; margin:3px auto">
@if ($user->photo)
      <img src="{{url('/attachments/profiles/'.Auth::user()->photo)}}" class="card-img-top img-thumbnail" alt="...">

@else
      <img src="{{URL::asset('assets/images/user_icon.png')}}" class="card-img-top rounded" alt="...">

@endif
 <div class="card-body">
    <h5 class="card-title">{{ $user->name }} <br><small style="font-weight: normal;">id: {{ $user->id }}</small>
</h5>
    <p class="card-text">
   <ul class="list-group mb-3">
  <li class="list-group-item list-group-item-secondary ">
<h5>{{ __('department.Collage') }}</h5>
<p class="ml-3 mr-3">{{ $user->department->collage->name }}</p>
</li>
<li class="list-group-item list-group-item-secondary">
<h5>{{ __('department.department') }}</h5>
<p class="ml-3 mr-3">{{ $user->department->name }}</p>
</li>
@if ($user->user_type==5)
    
<li class="list-group-item list-group-item-secondary">
<h5>{{ __('department.Year') }}</h5>
<p class="ml-3 mr-3">

@switch($user->year)
    @case(1)
       {{__('course.first')}}
        @break
    @case(2)
       {{__('course.Second')}}
        @break
    @case(3)
       {{__('course.Third')}}
        @break
    @case(4)
       {{__('course.Fourth')}}
        @break
    @case(5)
       {{__('course.fifth')}}
        @break
    @case(6)
       {{__('course.sixth')}}
        @break
    @default
{{__('course.error')}}
@endswitch
</p>
</li>
@endif
@if ($user->user_type<5 and $user->user_type>1)
    
<li class="list-group-item list-group-item-secondary">
<h5>{{ __('auth.specification') }}</h5>
<p class="ml-3 mr-3">{{ $user->specification }}</p>
</li>
@endif

<li class="list-group-item list-group-item-secondary">
<h5>{{ __('auth.phone') }}</h5>
<p class="ml-3 mr-3">{{ $user->phone }}</p>
</li>

   </ul>
    </p>
    <button type="button" class="btn btn-warning btn-sm mr-3" data-toggle="modal" data-target="#exampleModalCenter">
<i class="fa fa-edit"></i> {{ __('department.Edit') }}
</button>
  </div>
</div>
</div>







<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">{{ $user->name }}</h5>
      
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card ">
            <div class="card-body">
                <!-- add_form -->
                <form action="{{ route('user.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <label for="name" class="mr-sm-2">{{ trans('auth.name') }}
                                :</label>
                            <input id="name" type="text" name="name" class="form-control" value="{{ $user->getTranslation('name', 'ar') }}">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="col">
                            <label for="name_en" class="mr-sm-2">{{ trans('auth.name_en') }}
                                :</label>
                            <input type="text" class="form-control" name="name_en" value="{{ $user->getTranslation('name', 'en') }}">
                            @error('name_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="email" class="mr-sm-2">{{ trans('auth.email') }}
                                :</label>
                            <input id="email" type="email" name="email" class="form-control" value="{{ $user->email }}">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="password" class="mr-sm-2">{{ trans('auth.password') }}
                                :</label>
                            <input type="password" class="form-control" name="password" >
                            @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>  
<input type="hidden" name="department_id" value="{{ $user->department_id }}">
<input type="hidden" name="user_type" value="{{ $user->user_type }}">
<input type="hidden" name="edit" value="5">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="phone" class="mr-sm-2">{{ trans('auth.phone') }}
                                :</label>
                            <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                            @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>   
                    <div class="row mb-3">
@if ($user->user_type==5)
    

 <div class="col">
                            <label for="year" class="mr-sm-2">{{ __('department.Year') }}
                                :</label>
                            
<select name="year"  >
<option selected disabled>{{ __('department.Choose_Years') }}</option>
    <option value="1" {{ $user->year==1?'selected':''}}>1</option>
    <option value="2" {{ $user->year==2?'selected':''}}>2</option>
    <option value="3"{{ $user->year==3?'selected':''}} >3</option>
    <option value="4" {{ $user->year==4?'selected':''}}>4</option>
    <option value="5" {{ $user->year==5?'selected':''}}>5</option>
    <option value="6" {{ $user->year==6?'selected':''}}>6</option>
</select>  

                            @error('year')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
@else
    
<div class="col">
                            <label for="specification" class="mr-sm-2">{{ __('teacher.specification') }}</label>

                                <input id="specification" type="text" class="form-control @error('specification') is-invalid @enderror" name="specification" value="{{ $user->getTranslation('specification','ar') }}" required autocomplete="specification" autofocus>

                                @error('specification')
                                    <span class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
<div class="col">
                            <label for="specification_en" class="mr-sm-2">{{ __('teacher.specification_en') }}</label>

                                <input id="specification_en" type="text" class="form-control @error('specification_en') is-invalid @enderror" name="specification_en" value="{{ $user->getTranslation('specification','en') }} " required autocomplete="specification_en" autofocus>

                                @error('specification_en')
                                    <span class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
@endif


</div>
                    <div class="row mb-3">
<div class="col">
<label for="photo" class="mr-sm-2">{{ __('admin.photo') }}</label>

        <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo"   accept="image/*" autofocus>

        @error('photo')
            <span class="alert alert-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
</div></div>
          
                    
                   
            
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       <button type="submit" class="btn btn-warning" >{{ __('Collages_trans.submit') }}</button>
            </form>

            </div>
        </div>
    </div>
      {{-- <div class="modal-footer">
       
      </div> --}}
    </div>
  </div>
</div>

@endsection
 {{-- <div class="card-body">
              <br>
            <div class="card-body">
                <!-- add_form -->
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
          <th colspan="2"><h3>{{ $user->name }}</h3></th>
        </tr>
        </thead>
        <tbody>
<tr>
    <th class="table-success">{{ __('student.department') }}</th>
<th>{{ $user->department->name }}</th>
</tr>
<tr>
<th class="table-success">{{ __('auth.year') }}</th>
<th>@switch($user->year)
    @case(1)
       {{__('course.first')}}
        @break
    @case(2)
       {{__('course.Second')}}
        @break
    @case(3)
       {{__('course.Third')}}
        @break
    @case(4)
       {{__('course.Fourth')}}
        @break
    @case(5)
       {{__('course.fifth')}}
        @break
    @case(6)
       {{__('course.sixth')}}
        @break
    @default
{{__('course.error')}}
@endswitch</th>
</tr>

<tr>
    <th class="table-success">{{ __('department.Courses') }}</th>
<th>
<div class="list-group hover">
@forelse ($courses as $course)
  <a href="{{ route('department.course.show',[$course->department->id,$course->id]) }}" class="list-group-item list-group-item-action">{{ $course->name }}</a>
  @empty
    
@endforelse
</div>
</th>
</tr>
        </tbody></table>
        </div>
    


            </div>
        </div> --}}
@section('js')

@endsection
