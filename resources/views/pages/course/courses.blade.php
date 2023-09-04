@extends('layouts.master')
@section('css')

@section('title')
    {{ __('department.Courses') }}
@stop 
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('department.Courses') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
								
  @if (Auth::user()->user_type <3 )
              
<a class="btn btn-success btn-sm btn-lg pull-right"
 href="{{ route('department.course.create',$department->id )}}">
{{ __('department.Add_Course') }}
</a>
<br>
@endif
<br>


    <div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>id</th>
            <th>{{ __('department.Course') }}</th>
<th>{{ __('department.Year') }}</th>
<th>{{ __('course.season') }}</th>
            <th>{{ __('department.Collage') }}</th>
            <th>{{ __('department.department') }}</th>
            <th>{{ trans('Collages_trans.Processes') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($courses as $course)
            <tr>
                <td>{{ $course->id }}</td>
                <td>{{ $course->name }}</td>
                <td>{{ $course->year }}</td>
                <td>{{ $course->season==1?__('course.first_season'):__('course.second_season') }}</td>
<td>
{{ $course->department->collage->name }}
</td> 
<td>
	{{ $course->department->name }}	
</td>
    <td style="display: flex;justify-content:center">
        @if ((Auth::user()->user_type<5 && ((Auth::id() == $course->teacher)||(Auth::id() == $course->teacher2)))||Auth::user()->user_type<3)

<a href="{{ route('courseStudents',$course->id) }}" title="{{ trans('admin.students') }}"  class="btn btn-warning btn-sm "> <i class="fas fa-user-graduate"></i></a>
       <div class="btn-group ml-1 mr-1" >
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
{{ __('exam.questions') }}
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="{{ route('course.question.index',$course->id) }}">{{ __('exam.questions') }}</a>
<a class="dropdown-item" href="{{ route('course.question.create',$course->id) }}">{{ __('exam.add_questions') }}</a>
  </div>
</div>
@endif
        <a href="{{ route('department.course.show',[$department->id,$course->id]) }}" title="{{ trans('department.Show') }}"
                class="btn btn-warning btn-sm mr-3"><i class="fa fa-eye"></i></a>
        @if ((Auth::user()->user_type==2 && (Auth::user()->department_id == $course->department_id))||Auth::user()->user_type==1)

 <button type="button" class="btn btn-warning btn-sm mr-3" data-toggle="modal" data-target="#exampleModalCenter{{ $course->id }}">
<i class="fa fa-edit"></i>
</button>
    {{-- <a href="{{ route('department.course.edit',[$department->id,$course->id]) }}" title="{{ trans('department.Edit') }}"  class="btn btn-primary btn-sm mr-3">
            <i class="fa fa-edit"></i>
    </a> --}}


<form action="{{ route('department.course.destroy',[$department->id,$course->id]) }}" method="post" >
@method('DELETE')
@csrf
 <button type="submit" class="btn btn-danger btn-sm"  title="{{ trans('department.Delete') }}"><i class="fa fa-trash"></i></button>
</form>
@endif

                </td>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter{{ $course->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">{{ $course->name }}</h5>
      
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card ">
            <div class="card-body">
                <!-- add_form -->
                <form action="{{ route('department.course.update',[$department->id,$course->id]) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="row mb-3">
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
                    </div>   
                    <div class="row mb-3">

 <div class="col">
                            <label for="year" class="mr-sm-2">{{ __('department.Year') }}
                                :</label>
                            
<select name="year"  >
<option selected disabled>{{ __('department.Choose_Years') }}</option>
    <option value="1" {{ $course->year==1?'selected':''}}>1</option>
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

 <div class="col">
    <label for="season" class="mr-sm-2">{{ __('course.season') }}
        :</label>
                            
<select name="season" >
<option  value="1" {{ $course->season==1?'selected':''}}>{{ __('course.first_season') }}</option>
<option  value="2" {{ $course->season==2?'selected':''}}>{{ __('course.second_season') }}</option>
</select>  

            @error('season')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
                        </div>

</div>

             <div class="row mb-3">
                <div class="col">
    <label for="description"
        class="mr-sm-2">{{ __('course.description') }}
        :</label>

                    <div class="box">
                       <textarea class="form-control" name="description" id="" cols="30" rows="3">{{ $course->getTranslation('description', 'ar') }}</textarea>
                    </div>

                </div>
                <div class="col">
    <label for="description_en"
        class="mr-sm-2"> {{ __('course.description_en') }}
        :</label>

                    <div class="box">
                       <textarea class="form-control" name="description_en" id="" cols="30" rows="3">{{ $course->getTranslation('description', 'en') }}</textarea>
                    </div>

                </div>
             </div>
                    <div class="row mb-3">

 <div class="col">
    <label for="teacher" class="mr-sm-2">{{ __('admin.teacher') }}
        :</label>
                            
<select name="teacher"   >
@forelse ($course->x($course->department_id) as $user)
           <option value="{{ $user->id }}" {{ $user->id==$course->teacher?'selected':'' }}> {{ $user->name }} </option> 
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
                            
<select name="teacher2"   >
@forelse ($course->x($course->department_id) as $user)
           <option value="{{ $user->id }}" {{ $user->id==$course->teacher2?'selected':'' }}>{{ $user->name }}</option> 
@empty
    <option disabled>{{ __('course.no_teachers') }}</option>
@endforelse
</select>  

            @error('teacher2')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
                        </div>
                    </div>
                   
            
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
            </tr>



        @endforeach
    </table>
</div>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
