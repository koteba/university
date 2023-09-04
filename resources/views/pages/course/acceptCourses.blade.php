@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ __('course.acceptCourse') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ __('course.acceptCourse') }}
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


<div class="panel-group" id="accordion1">

@foreach ($courses as $year =>$mycourses)
    
<div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapse{{ $year }}" class="btn btn-outline-danger">
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
                        </a>
                    </h4>
                </div>
                <div id="collapse{{ $year }}" class="panel-collapse collapse">
                    <div class="panel-body">

    <div class="panel-group" id="accordion2">
                        
{{--  *********  --}}
@foreach ($mycourses as $course) 
@if ($course->teacher == Auth::id()  || Auth::user()->user_type==1)
    
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion2" href="#collapse{{ $year }}{{ $course->id }}" class="btn btn-outline-primary">
{{ $course->name }} / {{ $course->department->name }} / {{ $course->department->collage->name }}
                                        </a>
                                    </h4>
                                </div>
    
    <div id="collapse{{ $year }}{{ $course->id }}" class="panel-collapse collapse in">
<table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="20" style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>#</th>
            <th>{{ __('admin.user_name') }}</th>
<th>{{ __('course.status') }}</th>
            <th>{{ trans('Collages_trans.Processes') }}</th>
        </tr>
        </thead>
        <tbody>
<?php $i = 0; 
$students = array();
?>
@foreach ($course->users as $user)
@if ($user->user_type==5     )
    <?php 
array_push($students,$user);
?>
@endif
@endforeach

<?php 
$users=array_unique($students);
?>
@foreach ($users as $user)
    
      <div class="panel-body">
<tr>
                <?php $i++; ?>
<td>{{ $i }}</td>
<td>{{ $user->name }}</td>
<td style="display: flex;justify-content:center">
        <button data-courseid="{{ $course->id }}_s" data-course="{{ $course->id }}_s{{ $user->id }}" data-userid="{{ $user->id }}" title="{{ trans('course.accept') }}"
                class="btn btn-warning  mr-3 sign" value="{{ $course->id }}">
            {{ __('course.accept') }}
        </button>
<button data-courseid="{{ $course->id }}_u" data-course="{{ $course->id }}_u{{ $user->id }}" data-userid="{{ $user->id }}" title="{{ trans('course.deny') }}"
                class="btn   mr-3 unsign btn-disabled" value="{{ $course->id }}" disabled>
            {{ __('course.deny') }}
        </button>

                </td>
</tr>
</div>

@endforeach
        </tbody></table></div>

                                </div>
@endif

@endforeach
                            </div>


{{--  *********  --}}
                           
                        </div>

                    </div>
                </div>
@endforeach
            </div>

        </div>

    </div></div>
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
        url: '{!!URL::to('/acceptOldCourse')!!}',
        type: 'get',
        data: {user_id : user_id,course_id:course_id},
        
success: function() {
$('*[data-course="' + course_id + '_s'+user_id+'"]').removeClass('btn-warning').addClass('btn-disabled');
$('*[data-course="' + course_id + '_u'+user_id+'"]').removeClass('btn-disabled').addClass('btn-danger');

$('*[data-course="' + course_id + '_s'+user_id+'"]').prop('disabled', true);

$('*[data-course="' + course_id + '_u'+user_id+'"]').prop('disabled', false);
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
        url: '{!!URL::to('/denyOldCourse')!!}',
        type: 'get',
        data: {user_id : user_id,course_id:course_id},
        success: function() {
$('*[data-course="' + course_id +'_u'+user_id+'"]').removeClass('btn-danger').addClass('btn-disabled');
$('*[data-course="' + course_id +'_s'+user_id+'"]').removeClass('btn-disabled').addClass('btn-warning');

$('*[data-course="' + course_id +'_s'+user_id+'"]').prop('disabled', false);

$('*[data-course="' + course_id +'_u'+user_id+'"]').prop('disabled', true);
            console.log("Data sent!");
        }
    });
});
</script>

@endsection







