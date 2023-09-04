@extends('layouts.master')
@section('css')

@section('title')
        {{ __('main_trans.Collages') }}

@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.Collages') }}
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
             
<a class="btn btn-success btn-sm btn-lg pull-right" href="{{ route('collage.create') }}">
{{ trans('Collages_trans.add_Collage') }}
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
            <th>{{ trans('Collages_trans.Name') }}</th>
@if (Auth::user()->user_type==1)

            <th>{{ trans('Collages_trans.Processes') }}</th>
@endif
        </tr>
        </thead>
        <tbody>
        <?php $i = 0; ?>
        @foreach ($collages as $collage)
            <tr>
                <?php $i++; ?>
                <td>{{ $i }}</td>
                <td>{{ $collage->name }}</td>
@if (Auth::user()->user_type==1)

                <td style="display: flex;justify-content:center">
                    <a href="{{ route('collage.edit',$collage->id) }}" title="{{ trans('Collages_trans.Edit') }}"
                            class="btn btn-primary btn-sm mr-3"><i class="fa fa-edit"></i></a>

<form action="{{ route('collage.destroy',$collage->id) }}" method="post" >
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
