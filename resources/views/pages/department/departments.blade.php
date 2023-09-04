@extends('layouts.master')
@section('css')

@section('title')
        {{ __('department.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
        {{ __('department.title_page') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
								
  @if (Auth::user()->user_type==1)
              
<a class="btn btn-success btn-sm btn-lg pull-right" href="{{ route('department.create') }}">
{{ trans('My_sections_trans.add_section') }}
</a>
<br>
@endif
<br>


    <div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>#</th>
            <th>{{ trans('My_sections_trans.Name_section') }}</th>
            <th>{{ __('department.Years') }}</th>
            <th>{{ trans('main_trans.Collages') }}</th>
<td>{{ __('department.show_courses') }}</td>
@if (Auth::user()->user_type==1)

<td>{{ __('department.add_courses') }}</td>
            <th>{{ trans('Collages_trans.Processes') }}</th>
@endif
        </tr>
        </thead>
        <tbody>
        <?php $i = 0; ?>
        @foreach ($departments as $department)
            <tr>
                <?php $i++; ?>
                <td>{{ $i }}</td>
                <td>{{ $department->name }}</td>
                <td>{{ $department->years }}</td>
<td>
	{{ $department->collage->name }}	
</td>
<td>
<a href="{{ route('department.course.index',$department->id) }}" title="{{ trans('Collages_trans.Edit') }}"  class="btn btn-warning btn-sm mr-3">
<i class="fa fa-eye"></i></a>
</td>
@if (Auth::user()->user_type==1)

<td>
<a href="{{ route('department.course.create',$department->id) }}" title="{{ trans('Collages_trans.Edit') }}"
                            class="btn btn-primary btn-sm mr-3"> <i class="fa fa-plus"></i></a>
</td>
                <td style="display: flex;justify-content:center">
                    <a href="{{ route('department.edit',$department->id) }}" title="{{ trans('Collages_trans.Edit') }}"
                            class="btn btn-primary btn-sm mr-3"><i class="fa fa-edit"></i></a>

<form action="{{ route('department.destroy',$department->id) }}" method="post" >
@method('DELETE')
@csrf
 <button type="submit" class="btn btn-danger btn-sm"  title="{{ trans('Collages_trans.delete_Collage') }}"><i class="fa fa-trash"></i></button>
</form>
                </td>
@endif
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
