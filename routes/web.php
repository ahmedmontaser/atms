<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\AnswerController;
use App\Http\Controllers\Backend\AttendanceController;
use App\Http\Controllers\Backend\QuestionController;
use App\Http\Controllers\Backend\RequestController;


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

Route::get('/home', [App\Http\Controllers\Backend\EmployeeController::class , 'userRedirection']);

Route::get('/', [App\Http\Controllers\Backend\EmployeeController::class , 'homeRedirection']);


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/loginAdmin', [AdminController::class, 'create'])->middleware('AuthAdmin:admin');
Route::get('/loginAdmin', [AdminController::class, 'index']);
Route::post('/loginAdmin', [AdminController::class, 'create']);


Route::post('/logoutAdmin', [AdminController::class, 'logout']);

Route::get('/admin/home', [AdminController::class, 'show'])->name('adminHome');
Route::get('/employee/home', [EmployeeController::class, 'home']);
Route::post('/departments/create', [App\Http\Controllers\Backend\DepartmentController::class, 'store']);
Route::get('/departments/destroy/{id}', [App\Http\Controllers\Backend\DepartmentController::class, 'destroy']);
Route::get('/requests/destroy/{id}', [App\Http\Controllers\Backend\RequestController::class, 'destroy']);
Route::get('/requests/edit/{id}', [App\Http\Controllers\Backend\RequestController::class, 'edit']);
Route::post('/employees/edit', [App\Http\Controllers\Backend\EmployeeController::class, 'edit']);
Route::get('/employees/list', [App\Http\Controllers\Backend\EmployeeController::class, 'list']);

Route::resource('employees',App\Http\Controllers\Backend\EmployeeController::class);
Route::resource('questions',App\Http\Controllers\Backend\QuestionController::class);
Route::get('/questions/destroy/{id}', [App\Http\Controllers\Backend\QuestionController::class, 'destroy']);

Route::get('Updating',[App\Http\Controllers\Backend\EmployeeController::class , 'editView']);

Route::get('check',[App\Http\Controllers\Backend\EmployeeController::class , 'check']);
Route::get('out',[App\Http\Controllers\Backend\EmployeeController::class , 'out']);
Route::get('check_out_list',[App\Http\Controllers\Backend\RequestController::class , 'headcheckout']);

Route::resource('departments',App\Http\Controllers\Backend\DepartmentController::class);


Route::resource('attendances', App\Http\Controllers\Backend\AttendanceController::class);
Route::resource('requests', App\Http\Controllers\Backend\RequestController::class);
Route::get('requests/update/{id}/{respond}', [App\Http\Controllers\Backend\RequestController::class , 'update']);
Route::get('notifications/update/{id}/{accept}', [App\Http\Controllers\Backend\NotificationController::class , 'update']);

Route::get('rest' ,  [EmployeeController::class  , 'restView']);
Route::post('resting' ,  [EmployeeController::class  , 'restPassword']);
/*
Route::get('test' , function (){

        $img = Image::make('css/foo.jpg')->resize(300, 200);

        return $img->response('jpg');
});
*/


Route::get('selection', [App\Http\Controllers\Backend\EmployeeController::class , 'select']);
Route::get('getNewNotificationsNumberHead', [App\Http\Controllers\Backend\EmployeeController::class , 'getNewNotificationsNumberHead']);
Route::get('getNewNotificationsNumberUser', [App\Http\Controllers\Backend\EmployeeController::class , 'getNewNotificationsNumberUser']);
Route::get('getNotificationsUser', [App\Http\Controllers\Backend\EmployeeController::class , 'getNotificationsUser']);
Route::get('getNewNotificationsNumberAdmin', [App\Http\Controllers\Admin\AdminController::class , 'getNewNotificationsNumberAdmin']);
Route::get('getNotificationsHead', [App\Http\Controllers\Backend\EmployeeController::class , 'getNotificationsHead']);
Route::get('getNotificationsAdmin', [App\Http\Controllers\Admin\AdminController::class , 'getNotificationsAdmin']);


Route::post('addingEmployee', [App\Http\Controllers\Backend\EmployeeController::class , 'addMember']);
Route::get('employees/update/{id}', [App\Http\Controllers\Backend\EmployeeController::class , 'update']);
Route::get('employees/destroy/{id}', [App\Http\Controllers\Backend\EmployeeController::class , 'destroy']);
Route::get('employees/viewRequest/{notificationId}', [App\Http\Controllers\Backend\EmployeeController::class , 'viewRequest']);

Route::get('employees-notifications', [App\Http\Controllers\Backend\EmployeeController::class , 'notifications']);

Route::get('admins/viewRequest/{notificationId}', [App\Http\Controllers\Admin\AdminController::class , 'viewRequest']);
Route::get('admins/notifications', [App\Http\Controllers\Admin\AdminController::class , 'notifications']);
Route::get('employees/acceptRequest/{notificationId}', [App\Http\Controllers\Backend\EmployeeController::class , 'acceptRequest']);
Route::get('employees/rejectRequest/{notificationId}', [App\Http\Controllers\Backend\EmployeeController::class , 'rejectRequest']);


Route::get('employees/acceptRequestNotification/{requestId}', [App\Http\Controllers\Backend\EmployeeController::class , 'acceptRequestNotification']);
Route::get('employees/rejectRequestNotification/{requestId}', [App\Http\Controllers\Backend\EmployeeController::class , 'rejectRequestNotification']);

Route::get('getAttendanceHours' , [App\Http\Controllers\Backend\EmployeeController::class , 'getAttendanceHours']);

Route::get('getRandomHour' , [App\Http\Controllers\Admin\AdminController::class , 'getRandomHour']);



