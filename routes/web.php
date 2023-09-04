<?php

use App\Http\Middleware\CheckType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware' => ['guest']], function () {

    Route::get('/', function () {
        return view('auth.login');
    });

});

Route::get('/choose','HomeController@choose')->name('choose');


 //==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth',"checkType"]
    ], function () {

     //==============================dashboard============================
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

   //==============================dashboard============================
   
Route::resource('user', 'UserController')->withoutMiddleware([CheckType::class]);
Route::resource('collage', 'CollageController');
Route::resource('department', 'DepartmentController');
Route::resource('department.course', 'CourseController');
Route::resource('mark', 'MarkController');
Route::resource('message', 'MessageController');
Route::resource('meeting', 'MeetingController');
Route::resource('exam', 'ExamController');
Route::resource('post', 'PostController');
Route::resource('post.comment', 'CommentController');
Route::resource('course.question', 'QuestionController');
Route::resource('course.lecture', 'LectureController');
// comments for lecture
Route::post('/comment_store/{course}/{lecture}','CommentController@storeForLecture')->name('storeForLecture');
Route::delete('/comment/{course}/{lecture}/{comment}','CommentController@destroyForLecture')->name('destroyForLecture');
Route::post('/comment_edit/{course}/{lecture}','CommentController@editForLecture')->name('editForLecture');

Route::get('/myCourses/{id}','CourseController@myCourses')->name('myCourses');

Route::get('/getdepartments', 'DepartmentController@getDepartments')->withoutMiddleware([CheckType::class]);
Route::get('/getyears', 'DepartmentController@getyears');

Route::get('/student', 'UserController@student')->name('register_student')->withoutMiddleware([CheckType::class]);
Route::get('/teacher', 'UserController@teacher')->name('register_teacher')->withoutMiddleware([CheckType::class]);
Route::get('/students', 'UserController@students')->name('students');
Route::get('/teachers', 'UserController@teachers')->name('teachers');
Route::get('/Confirmteachers', 'UserController@confirm_teachers')->name('confirm_teachers');

Route::get('/Confirmteacher/{user}', 'UserController@confirm_teacher')->name('confirm_teacher');
Route::get('/updateRole', 'UserController@updateRole')->name('updateRole');
Route::post('/updateCourses', 'UserController@updateCourses')->name('updateCourses');
Route::get('/oldCourses', 'CourseController@oldCourses')->name('oldCourses');

Route::get('/signOldCourse', 'CourseController@signOldCourse')->name('signoldCourses');
Route::get('/unsignOldCourse', 'CourseController@unsignOldCourse')->name('unsignoldCourses');


Route::get('/acceptOldCourse', 'CourseController@acceptOldCourse')->name('acceptoldCourses');
Route::get('/denyOldCourse', 'CourseController@denyOldCourse')->name('denyoldCourses');
Route::get('/courseStudents/{course}', 'CourseController@students')->name('courseStudents');
Route::get('/acceptCourseSign', 'CourseController@acceptCourseSign')->name('acceptCourseSign');
Route::post('/code', 'ExamController@code')->name('code');
Route::get('/e', 'ExamController@e')->name('e');
Route::post('/exam', 'ExamController@index')->name('exaam');
Route::post('/examStore', 'ExamController@store')->name('exam.store');
Route::post('/examSubmit', 'ExamController@submit')->name('exam.submit');
Route::post('/Upload_attachment/{lecture}', 'LectureController@Upload_attachment')->name('lecture_Upload_attachment');
Route::get('Download_attachment/{lecture}/{image}', 'LectureController@Download_attachment')->name('Download_attachment');
Route::get('Download_attachment/{image}', 'PostController@Download_attachment')->name('post_Download_attachment');
Route::post('Delete_attachment/{lecture}', 'LectureController@Delete_attachment')->name('lecture_Delete_attachment');
Route::post('Delete_attachment/{post}', 'PostController@Delete_attachment')->name('post_Delete_attachment');
Route::post('check-mark', 'MarkController@checkMark')->name('check-mark');

// excel
Route::get('import-export', 'DataTableController@importExport')->name('import_export');
Route::post('import', 'DataTableController@import')->name('import');
Route::get('export', 'DataTableController@export');

Route::get('import-export-mark', 'MarkController@importExport')->name('import_export_mark');
Route::post('importMark', 'MarkController@import')->name('import_mark');
Route::get('exportMark', 'MarkController@export_mark');
// end excel


//notifications
Route::get('usread/{message}', 'MessageController@usread')->name('usread');
Route::get('Allasread', 'MessageController@Allasread')->name('Allasread');
Route::get('deleteMessage/{message}', 'MessageController@deleteMessage')->name('deleteMessage');


// zoom
Route::get('/meetings', 'MeetingController@list')->name('meetings');
Route::get('Download_zoom','MeetingController@Download_zoom')->name('Download_zoom');
Route::get('/old_meetings', 'MeetingController@old_meetings')->name('old_meetings');


});

