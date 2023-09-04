@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans("admin.students") }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
 {{ $course->department->name }} / {{ $course->name }} / {{ trans("admin.students") }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
<div class="row">
<div class="col-md-12 mb-30">
    <div class="card card-statistics h-100">
       

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        
    </div>
@endif


 
      <div class="card-body">
   <div class="table-responsive">
<table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="20" style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>id</th>
            <th>{{ __('admin.user_name') }}</th>
            <th>{{ __('auth.email') }}</th>
            <th>{{ __('auth.department') }}</th>
            <th>{{  __('department.Year') }}</th>
            <th >{{ trans('Collages_trans.Processes') }}</th>
        </tr>
        </thead>
        <tbody>
       @foreach ($users as $user)
                <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>

<td>{{ $user->department->name }}</td>
<td>
    {{ $user->year }}
</td>
<td>
<div style="display: flex;justify-content:center">
<a href="{{ route('user.show',$user->id) }}" title="{{ trans('Collages_trans.Edit') }}"  class="btn btn-warning btn-sm mr-3">
<i class="fa fa-eye"></i>
</a>
@if (Auth::user()->user_type==1)
    
 <a href="{{ route('user.edit',$user->id) }}" title="{{ trans('Collages_trans.Edit') }}"  class="btn btn-primary btn-sm mr-3">
<i class="fa fa-edit"></i>
</a>

<form action="{{ route('user.destroy',$user->id) }}" method="post" >
@method('DELETE')
@csrf
 <button type="submit" class="btn btn-danger btn-sm"  title="{{ trans('Collages_trans.delete_Collage') }}"><i class="fa fa-trash"></i></button>
</form>

@endif
</div>
                </td>
            </tr>
@endforeach
        </tbody>
    </table>
</div>

 </div>
    </div>
  </div>
</div>






        @endsection
        @section('js')
            @toastr_js
            @toastr_render
            
@endsection
