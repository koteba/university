<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg" style="overflow: scroll">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
    <a href="{{ url('/dashboard') }}">
        <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
        </div>
        <div class="clearfix"></div>
    </a>
</li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10  pl-4 font-medium menu-title"   style="color: #f9767b">{{trans('main_trans.Programname')}} </li>

@if (Auth::user()->user_type<5)
    
                    <!-- Collages-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Collages-menu">
                            <div class="pull-left"><i class="fas fa-school"></i><span
                                    class="right-nav-text">{{trans('main_trans.Collages')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Collages-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('collage.index') }}">{{trans('main_trans.Collages_list')}}</a></li>

                        </ul>
                    </li>
                    <!-- departments-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                            <div class="pull-left"><i class="fa fa-building"></i><span
                                    class="right-nav-text">{{trans('main_trans.sections')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('department.index') }} ">{{trans('main_trans.List_sections')}}</a></li>


                           
                        </ul>
                    </li>


                  
@endif


                    <!-- courses-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu">
                            <div class="pull-left"><i class="fas fa-user-graduate"></i></i></i><span
                                    class="right-nav-text">{{trans('department.Courses')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="students-menu" class="collapse" data-parent="#sidebarnav">
@if (Auth::user()->department_id)
    <li> <a href="
{{ route('department.course.index',Auth::user()->department_id) }}
">{{ __('course.Courses_list') }}</a> </li>
@endif                            

      <li> <a href="{{ route('myCourses',Auth::id()) }}">
{{ __('admin.my_courses') }}</a> </li>
@if (Auth::user()->user_type==5)
<li> <a href="{{ route('mark.index') }}">
{{ __('course.marks') }}</a> </li>
@endif

@if (Auth::user()->user_type<5)

       <li> <a href="{{ route('acceptCourseSign') }}">
{{ __('course.acceptCourse') }}</a> </li>


      <li> <a href="{{ route('import_export_mark') }}">
{{ __('course.marks') }}</a> </li>
@endif                            
                        </ul>
                    </li>



                    <!-- Teachers-->
                    {{-- <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Teachers-menu">
                            <div class="pull-left"><i class="fas fa-chalkboard-teacher"></i></i><span
                                    class="right-nav-text">{{trans('main_trans.Teachers')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Teachers-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href=" ">{{trans('main_trans.List_Teachers')}}</a> </li>
                        </ul>
                    </li> --}}


                  
@if (Auth::user()->user_type<3)

                    <!-- Accounts-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Accounts-menu">
                            <div class="pull-left"><i class="fas fa-money-bill-wave-alt"></i><span
                                    class="right-nav-text">{{trans('admin.accounts')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Accounts-menu" class="collapse" data-parent="#sidebarnav">
                           
 <li><a href="{{ route('teachers') }}"><i class="fas fa-chalkboard-teacher"></i>  {{ __('admin.teachers') }} </a> </li>

                            <li><a href="{{ route('students') }}"> <i class="fas fa-user-graduate"></i>{{ __('admin.students') }}</a> </li>
@if (Auth::user()->user_type<3)

                            <li> <a href="{{ route('confirm_teachers') }}"> <i class="fas fa-check-double"></i>{{ __('admin.confirm_teachers') }}</a> </li>
<li> <a href="{{ route('import_export') }}"> <i class="fas fa-file-import"></i>{{ __('admin.import_export') }}</a> </li>
@endif
                        </ul>
                    </li>

@endif
                    <!-- Exams-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams-icon">
                            <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">{{trans('main_trans.Exams')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Exams-icon" class="collapse" data-parent="#sidebarnav">
@if (Auth::user()->user_type<5)

                            <li> <a href="{{ route('exam.create') }}">{{ __('exam.create_exam') }}</a> </li>
@endif
@if (Auth::user()->user_type==5)

                            <li> 
<form action="{{ route('code') }}" method="post">
@csrf
<a href="#" onclick="$(this).closest('form').submit()">{{ __('exam.enter_exam') }}</a>

</form>
</li>
  @endif                         
                        </ul>
                    </li>
<!-- blog-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#blog-icon">
                            <div class="pull-left"><i class="far fa-handshake"></i><span class="right-nav-text">{{trans('post.blog')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="blog-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ route('post.index') }}">{{trans('post.blog')}}</a> </li>
                            
                        </ul>
                    </li>

                    <!-- library-->
                    {{--  <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#library-icon">
                            <div class="pull-left"><i class="fas fa-book"></i><span class="right-nav-text">{{trans('main_trans.library')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="library-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="fontawesome-icon.html">font Awesome</a> </li>
                            <li> <a href="themify-icons.html">Themify icons</a> </li>
                            <li> <a href="weather-icon.html">Weather icons</a> </li>
                        </ul>
                    </li>  --}}


                    <!-- Onlinec lasses-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Onlineclasses-icon">
                            <div class="pull-left"><i class="fas fa-video"></i><span class="right-nav-text">{{trans('main_trans.Onlineclasses')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">
@if (Auth::user()->user_type < 5)
    
  <li> <a href="{{ route('meeting.create') }}">{{ __('meeting.create_online_lesson') }}</a> </li>
@endif                          

                            <li> <a href="{{ route('meeting.index') }}">{{ __('main_trans.Onlineclasses') }}</a> </li>


                           
                        </ul>
                    </li>

{{-- 
                    <!-- Settings-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Settings-icon">
                            <div class="pull-left"><i class="fas fa-cogs"></i><span class="right-nav-text">{{trans('main_trans.Settings')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Settings-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="fontawesome-icon.html">font Awesome</a> </li>
                            <li> <a href="themify-icons.html">Themify icons</a> </li>
                            <li> <a href="weather-icon.html">Weather icons</a> </li>
                        </ul>
                    </li>


                    <!-- Users-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Users-icon">
                            <div class="pull-left"><i class="fas fa-users"></i><span class="right-nav-text">{{trans('main_trans.Users')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Users-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="fontawesome-icon.html">font Awesome</a> </li>
                            <li> <a href="themify-icons.html">Themify icons</a> </li>
                            <li> <a href="weather-icon.html">Weather icons</a> </li>
                        </ul>
                    </li>
 --}}
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
