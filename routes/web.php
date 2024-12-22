<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeManagement;
use App\Http\Controllers\JobReportController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\DepartmentHeadMiddleware;
use App\Http\Middleware\EmployeeMiddleware;
use App\Http\Middleware\AuthMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'employeeRegister'])->name('employeeRegister');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'employeeLogin'])->name('employeeLogin');

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::get('/admin-dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::resource('departments', DepartmentController::class);
        Route::get('/assign-head/{id}', [DepartmentController::class, 'assignHead'])->name('departments.assign');
        Route::put('/designate-head', [DepartmentController::class, 'designateHead'])->name('departments.designate');
        Route::get('/employee-list', [DepartmentController::class, 'employeeList'])->name('departments.employee');
        Route::get('/employee-assign/{id}', [DepartmentController::class, 'assignEmployee'])->name('departments.employee-assign');
        Route::put('/designate-employee', [DepartmentController::class, 'designateEmployee'])->name('departments.assignDepartment');
        Route::get('/employee-jobs', [DepartmentController::class, 'employeeJobs'])->name('departments.employee-jobs');
    });
    Route::middleware(DepartmentHeadMiddleware::class)->group(function () {
        Route::get('/head-dashboard', [DashboardController::class, 'departmentHeadDashboard'])->name('department_head.dashboard');
        Route::get('/joblist', [EmployeeManagement::class, 'jobList'])->name('department_head.joblist');
        Route::get('/details/{id}', [EmployeeManagement::class, 'show'])->name('department_head.details');
    });
    Route::middleware(EmployeeMiddleware::class)->group(function () {
        Route::resource('jobreports', JobReportController::class);
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
