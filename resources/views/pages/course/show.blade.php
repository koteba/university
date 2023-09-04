@extends('layouts.master')
@section('css')

@section('title')
    {{ $course->name }} 
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ $course->name }} 
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
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th class="bolder">{{ __('course.name') }}</th>
         <td>{{ $course->name }}</td>
        </tr>
        <tr ">
            <th class="bolder">id</th>
         <td>{{ $course->id }}</td>
        </tr>
        </thead>
        <tbody>
<tr>
    <th>{{ __('department.department') }}</th>
<td>{{ $department->name }}</td>
</tr>
<tr>
<th>{{ __('department.Year') }}</th>
<th>@switch($course->year)
    @case(1)
        {{ __('course.first') }}
        @break
    @case(2)
        {{ __('course.Second') }}
        @break
    @case(3)
        {{ __('course.Third') }}
        @break
    @case(4)
        {{ __('course.Fourth') }}
        @break
    @case(5)
        {{ __('course.fifth') }}
        @break
    @case(6)
        {{ __('course.sixth') }}
        @break
    @default
        {{ __('course.error') }}
@endswitch</th>
</tr>
<tr>
<th>{{ __('course.description') }}</th>
<td>{{ $course->description }}</td>
</tr>
@if ($course->teacher>0)
   <tr>
<th>{{ __('admin.teacher') }}</th>
@forelse ($users as $user)
   <?php echo $user->id==$course->teacher? "<td>".$user->name."</td>":''; ?>
@empty
@endforelse
</tr> 
@endif
@if ($course->teacher2>0)
   <tr>
<th>{{ __('admin.teacher2') }}</th>
@forelse ($users as $user)
   <?php echo $user->id==$course->teacher2? "<td>".$user->name."</td>":''; ?>
@empty
@endforelse
</tr> 
@endif
<tr>
 <th  colspan="2" >
<div style="display: flex;justify-content:center">
@if (Auth::user()->user_type<2)

<a href="{{ route('department.course.edit',[$department->id,$course->id]) }}" title="{{ trans('department.Edit') }}"
                            class="btn btn-primary btn-sm mr-3  pr-5 pl-5"><i class="fa fa-edit"></i></a>


<form action="{{ route('department.course.destroy',[$department->id,$course->id]) }}" method="post" >
@method('DELETE')
@csrf
 <button type="submit" class="btn btn-danger btn-sm pr-5 pl-5"  title="{{ trans('department.Delete') }}"><i class="fa fa-trash"></i></button>
</form>
@endif
</div>
</th>
</tr>
        </tbody></table>
        </div>
    


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
