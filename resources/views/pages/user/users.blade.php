@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans("admin.$title") }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans("admin.$title") }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
<div class="row">
<div class="col-md-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">
        <a class="button x-small" href="{{ route('user.create') }}" data-toggle="modal" data-target="#exampleModal">
        {{ trans('admin.add') }}
</a>
                </div>

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


  @if ($conf>0)

<div id="accordion">

@foreach ($collages as $collage)
        @if ((Auth::user()->user_type==2 && (Auth::user()->department->collage_id == $collage->id))||Auth::user()->user_type==1)

  <div class="card">
    <div class="card-header" id="heading{{ $collage->id }}">
      <h5 class="mb-0">
        <button class="btn btn-outline-success pl-5 pr-5" data-toggle="collapse" data-target="#collapse{{ $collage->id }}" aria-expanded="false" aria-controls="collapse{{ $collage->id }}" style="font-family:Poppins, sans-serif">
          {{ $collage->name }}
        </button>
      </h5>
    </div>

    <div id="collapse{{ $collage->id }}" class="collapse " aria-labelledby="heading{{ $collage->id }}" data-parent="#accordion">
      <div class="card-body">
   <div class="table-responsive">
<table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="20" style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>#</th>
            <th>{{ __('admin.user_name') }}</th>
            <th>{{ __('auth.email') }}</th>
            <th>{{ __('admin.role') }}</th>
            <th>{{ __('auth.department') }}</th>
            <th>{{ ($title=='students') ? __('department.Year'):  __('course.Course') }}</th>
            <th >{{ trans('Collages_trans.Processes') }}</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0; ?>
        @foreach ($collage->departments as $department)
        @foreach ($department->users as $user)
        @foreach ($users as $use)
@if (Auth::user()->user_type == 2 && Auth::user()->department_id != $user->department_id)
   

 @else

            @if ($use->id == $user->id )
            <tr>
                <?php $i++; ?>
                <td>{{ $i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
<td>
@if ($user->user_type==7)
    <a href="{{ route('confirm_teacher',$user->id) }}"  class="btn btn-success">{{ __('admin.confirm_teacher') }}</a>
@else
   <form action="{{ route('updateRole',$user->id)  }}" method="post" class=" form-group   ">
@csrf
   <select name="user_type" onchange="updatee({{ $user->id }},this.value)">
@if (Auth::user()->user_type ==1 )
   <option value="1"{{ $user->user_type==1?'selected':''}}>
{{ __('admin.admin') }}</option>
<option value="2"{{ $user->user_type==2?'selected':''}}>{{ __('admin.department_head') }}</option>
 
@endif
<option value="3"{{ $user->user_type==3?'selected':''}}>{{ __('admin.teacher') }}</option>
<option value="4"{{ $user->user_type==4?'selected':''}}>{{ __('admin.teacher2') }}</option>
<option value="5"{{ $user->user_type==5?'selected':''}}>{{ __('admin.student') }}</option>
</select>
   </form>
@endif

</td>
<td>{{ $department->name }}</td>
<td>
@if ($title=='students')
    {{ $user->year }}
@else
<form action="{{ route('updateCourses') }}" method="post" style="display: flex; justify-content:center">
@csrf
<input type="hidden" name="user_id" value="{{ $user->id }}">
    <select name="courses[]" multiple  size="3">
@foreach ($user->courses as $my_course)
    <option value="{{ $my_course->id }}" selected>{{ $my_course->name }}</option>
@endforeach
@foreach ($user->department->courses as $course)
    <option value="{{ $course->id }}">{{ $course->name }}</option>

@endforeach
</select>
<input type="submit" value="تأكيد" class="btn btn-primary ml-3 mt-3 mb-3">
</form>
@endif

</td>
<td>
<div style="display: flex;justify-content:center">
<a href="{{ route('user.show',$user->id) }}" title="{{ trans('Collages_trans.Edit') }}"  class="btn btn-warning btn-sm mr-3">
<i class="fa fa-eye"></i>
</a>

 <a href="{{ route('user.edit',$user->id) }}" title="{{ trans('Collages_trans.Edit') }}"  class="btn btn-primary btn-sm mr-3">
<i class="fa fa-edit"></i>
</a>

<form action="{{ route('user.destroy',$user->id) }}" method="post" >
@method('DELETE')
@csrf
 <button type="submit" class="btn btn-danger btn-sm"  title="{{ trans('Collages_trans.delete_Collage') }}"><i class="fa fa-trash"></i></button>
</form></div>
                </td>
            </tr>
            @endif
            @endif
        @endforeach
        @endforeach
@endforeach
        </tbody>
    </table>
</div>

 </div>
    </div>
  </div>
@endif
@endforeach

@if ($xxx)
        

    <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-outline-success pl-5 pr-5 collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          {{ __('admin.other') }}
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        {{-- ***** --}}
<div class="table-responsive">
<table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>#</th>
            <th>user name</th>
            <th>email</th>
            <th>role</th>
            <th>department</th>
            <th colspan="2">{{ trans('Collages_trans.Processes') }}</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0; ?>
        @foreach ($xxx as $user)

            <tr>
                <?php $i++; ?>
                <td>{{ $i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
<td>
<form action="{{ route('updateRole',$user->id)  }}" method="post" class=" form-group   ">
@csrf
   <select name="user_type" onchange="updatee({{ $user->id }},this.value)">
<option value="1"{{ $user->user_type==1?'selected':''}}>
{{ __('admin.admin') }}</option>
<option value="2"{{ $user->user_type==2?'selected':''}}>{{ __('admin.department_head') }}</option>
<option value="3"{{ $user->user_type==3?'selected':''}}>{{ __('admin.teacher') }}</option>
<option value="4"{{ $user->user_type==4?'selected':''}}>{{ __('admin.teacher2') }}</option>
<option value="5"{{ $user->user_type==5?'selected':''}}>{{ __('admin.student') }}</option>
</select>
   </form></td>
<td>none</td>
<td>
<a href="{{ route('user.show',$user->id) }}" title="{{ trans('Collages_trans.Edit') }}"  class="btn btn-warning btn-sm mr-3">
<i class="fa fa-eye"></i>
</a>
</td>
  <td style="display: flex;justify-content:center">
 <a href="{{ route('user.edit',$user->id) }}" title="{{ trans('Collages_trans.Edit') }}"  class="btn btn-primary btn-sm mr-3">
<i class="fa fa-edit"></i>
</a>

<form action="{{ route('user.destroy',$user->id) }}" method="post" >
@method('DELETE')
@csrf
 <button type="submit" class="btn btn-danger btn-sm"  title="{{ trans('Collages_trans.delete_Collage') }}"><i class="fa fa-trash"></i></button>
</form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


       {{-- ***** --}}
      </div>
    </div>
  </div>
</div>


    @else
            <h1 class="alert alert-success">{{ __('admin.noConfirm') }}</h1>
        @endif    

@endif

    </div></div></div>




        @endsection
        @section('js')

            @toastr_js
            @toastr_render

<script>
function  updatee(id,type) {
    //get the selected value
    var selectedValue = type;
    //make the ajax call
    $.ajax({
        url: '{!!URL::to('/updateRole')!!}',
        type: 'get',
        data: {user_type : selectedValue,user_id:id},
        success: function() {
            console.log("Data sent!");
        }
    }); 
};
</script>
            <script>
                $(document).ready(function () {
                    $('select[name="Collage_id"]').on('change', function () {
                        let Collage_id = $(this).val();
                        if (Collage_id) {

                            var url = "{{ URL::to('getsections') }}";
                            //alert(url);
                            $.ajax({
                                {{--"{{ URL::to('sections') }}/" + Collage_id--}}
                                url: url,
                                type: "GET",
                                data:{Collage_id:Collage_id},
                                dataType: "json",
                                success: function (data) {
                                    alert(data);
                                    $('select[name="section_id"]').empty();
                                    $.each(data, function (key, value) {
                                        $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                                    });
                                },
                            });
                        } else {
                            console.log('AJAX load did not work');
                        }
                    });
                });
{{ URL::to('') }}
            </script> 


<script>
$(document).ready(function  courses(id,type) {
    //get the selected value
    var selectedValue = type;
    //make the ajax call
    $.ajax({
        url: '{!!URL::to('/updateCourses')!!}',
        type: 'get',
        data: {courses : selectedValue,user_id:id},
        success: function() {
            console.log("Data sent!");
        }
    });
});
</script>
@endsection
