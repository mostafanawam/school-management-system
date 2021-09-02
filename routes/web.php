<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::view('home', 'home');
/* ##################### Student #####################*/
Route::view('student/login', 'student.login');
Route::view('student/main', 'student.main');
Route::post('/student/main', [StudentController::class,'LoginStudent']);//if logged in redirect to main page

Route::get('student/schedule', [StudentController::class,'get_schedule']);
Route::get('student/calendar', [StudentController::class,'getcalendar']);

Route::get('/student/materials', [StudentController::class,'ShowMaterials']);//get the materials uploaded by the instructor
Route::get('/student/materials/download/{file}', [StudentController::class,'DownloadFile']);//download file

Route::get('/student/logout', [StudentController::class,'logoutStudent']);//logout user and return to login page

Route::view('/student/changepass', 'student.changepass');
Route::post('/student/change', [StudentController::class,'StudentChangePassword']);//ChangePassword


Route::post('/student/UpdateProfile', [StudentController::class,'UpdateInfo']);
Route::get('/student/profile/{id}', [StudentController::class,'StudentProfile']);//pass userid  to get chief data

Route::get('/student/results', [StudentController::class,'GetResults']);//get student results
/* ##################### admin #####################*/
Route::view('admin/login', 'admin.login');
Route::view('admin/main', 'admin.main');
Route::post('/admin/main', [AdminController::class,'LoginAdmin']);//if logged in redirect to main page

Route::get('admin/schedule', [AdminController::class,'GetSchedule']);//get all inst and courses
Route::post('/admin/schedule/addsession', [AdminController::class,'set_session']);
Route::get('/admin/schedule/delete/{id}', [AdminController::class,'deleteSession']);

Route::get('admin/calendar', [AdminController::class, 'index']);
Route::view('admin/adduser', 'admin.adduser');

Route::get('admin/userlist', [AdminController::class,'userlist']);//get the users list
Route::post('/admin/user/adduser', [AdminController::class,'adduser']);//insert user
Route::get('/admin/deleteuser/{id}', [AdminController::class,'deleteuser']);//delete user using id passed in url

Route::get('admin/viewuser/{id}', [AdminController::class,'ViewUser']);//view user  using id passed in url
Route::post('admin/update', [AdminController::class,'UpdateUser']);//update user data

Route::get('/admin/logout', [AdminController::class,'logout']);//request logout ,delete session and  return to login

Route::get('fullcalender', [AdminController::class, 'index']);
Route::post('fullcalenderAjax', [AdminController::class, 'ajax']);


Route::view('admin/changepass', 'admin.changepass');
Route::post('admin/change', [AdminController::class,'ChangePassword']);//ChangePassword


Route::post('/admin/UpdateProfile', [AdminController::class,'UpdateInfo']);
Route::get('/admin/profile/{id}', [AdminController::class,'AdminProfile']);//pass userid  to get chief data


/* ##################### teacher #####################*/

Route::view('teacher/login', 'teacher.login');
Route::view('teacher/main', 'teacher.main');
Route::post('/teacher/main', [TeacherController::class,'LoginTeacher']);//if logged in redirect to main page

Route::get('/teacher/materials', [TeacherController::class,'GetMaterials']);//upload materials  view
Route::post('/teacher/materials/upload', [TeacherController::class,'UploadMaterials']);//upload materials to students

Route::post('/teacher/grades/submit', [TeacherController::class,'SubmitGrades']);
Route::get('/teacher/grades', [TeacherController::class,'GetGrades']);//submit grades view view

Route::post('/teacher/attendance/submit', [TeacherController::class,'SubmitAttendance']);//submit attendance
Route::post('/teacher/attendance/create', [TeacherController::class,'CreateLecture']);//creatae lecture
Route::get('/teacher/attendance', [TeacherController::class,'GetAttendance']);//attendance view

Route::get('/teacher/logout', [TeacherController::class,'TeacherLogout']);

Route::view('/teacher/changepass', 'teacher.changepass');
Route::post('/teacher/change', [TeacherController::class,'TeacherChangePass']);//ChangePassword


Route::post('/teacher/UpdateProfile', [TeacherController::class,'UpdateInfo']);
Route::get('/teacher/profile/{id}', [TeacherController::class,'TeacherProfile']);//pass userid  to get chief data


Route::get('/teacher/exams', [TeacherController::class,'GetExam']);//return info related to exam assingment;
Route::post('/teacher/exams/assign', [TeacherController::class,'AssignExam']);//return info related to exam assingment;