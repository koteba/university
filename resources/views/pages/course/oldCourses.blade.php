@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ __('course.OldCourses') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ __('course.OldCourses') }}
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
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif



<div id="accordion">

        @foreach ($courses as $year =>$mycourses)

  <div class="card">
    <div class="card-header" id="heading{{ $year}}">
      <h5 class="mb-0">
        <button class="btn btn-outline-success pl-5 pr-5" data-toggle="collapse" data-target="#collapse{{ $year }}" aria-expanded="false" aria-controls="collapse{{ $year }}" style="font-family:Poppins, sans-serif">
@switch($year)
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
 </button>
      </h5>
    </div>

    <div id="collapse{{ $year }}" class="collapse " aria-labelledby="heading{{ $year }}" data-parent="#accordion">
      <div class="card-body">
   <div class="table-responsive">
<table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="20" style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>#</th>
            <th>{{ __('department.Course') }}</th>
            <th>{{ __('department.Collage') }}
/ {{ __('department.department') }}</th>
<th>{{ __('course.status') }}</th>
            <th>{{ trans('Collages_trans.Processes') }}</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0; ?>
        @foreach ($mycourses as $mycourse)
            <tr>
                <?php $i++; ?>
                <td>{{ $i }}</td>
                <td>{{ $mycourse->name }}</td>
<td>
{{ $mycourse->department->collage->name }}
/
	{{ $mycourse->department->name }}	 
</td>
    <td style="display: flex;justify-content:center">
        <button data-courseid="{{ $mycourse->id }}_s" data-userid="{{ Auth::id() }}" title="{{ trans('course.sign') }}"
                class="btn btn-warning  mr-3 sign" value="{{ $mycourse->id }}">
            {{ __('course.sign') }}
        </button>
<button data-courseid="{{ $mycourse->id }}_u" data-userid="{{ Auth::id() }}" title="{{ trans('course.sign') }}"
                class="btn   mr-3 unsign btn-disabled" value="{{ $mycourse->id }}" disabled>
            {{ __('course.usign') }}
        </button>

                </td>
            </tr> 

        @endforeach
        </tbody>
    </table>
</div>

 </div>
    </div>
  </div>
@endforeach


        @endsection
        @section('js')
            @toastr_js
            @toastr_render
           
<script>
$(".sign").on('click', function() {
    var course_id = $(this).attr('data-courseid');
course_id = course_id.slice(0, -2);

    var user_id = $(this).attr('data-userid');
    //make the ajax call
    $.ajax({
        url: '{!!URL::to('/signOldCourse')!!}',
        type: 'get',
        data: {user_id : user_id,course_id:course_id},
        
success: function() {
$('*[data-courseid="' + course_id + '_s"]').removeClass('btn-warning').addClass('btn-disabled');
$('*[data-courseid="' + course_id + '_u"]').removeClass('btn-disabled').addClass('btn-danger');

$('*[data-courseid="' + course_id + '_s"]').prop('disabled', true);

$('*[data-courseid="' + course_id + '_u"]').prop('disabled', false);
            console.log("Data sent!");
        }
    });
});

$(".unsign").on('click', function() {
    var course_id = $(this).attr('data-courseid');
course_id = course_id.slice(0, -2);
    var user_id = $(this).attr('data-userid');
    //make the ajax call
    $.ajax({
        url: '{!!URL::to('/unsignOldCourse')!!}',
        type: 'get',
        data: {user_id : user_id,course_id:course_id},
        success: function() {
$('*[data-courseid="' + course_id + '_u"]').removeClass('btn-danger').addClass('btn-disabled');
$('*[data-courseid="' + course_id + '_s"]').removeClass('btn-disabled').addClass('btn-warning');

$('*[data-courseid="' + course_id + '_s"]').prop('disabled', false);

$('*[data-courseid="' + course_id + '_u"]').prop('disabled', true);
            console.log("Data sent!");
        }
    });
});
</script>

@endsection







