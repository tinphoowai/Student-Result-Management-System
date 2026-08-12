<?php

use App\Http\Controllers\AcademicPlanController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Student\RegisterController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\SubjectController;
use App\Models\AcademicPlan;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Foundation\Bootstrap\RegisterProviders;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [RegisterController::class, 'showRegistrationForm']);
Route::post('/register', [RegisterController::class, 'register'])->name('students.register');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
Route::middleware(['auth:student'])->prefix('student')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('students.index');
    Route::get('/mark-certificate', [StudentController::class, 'showCertificateForm'])->name('students.getCertificate');
    Route::post('/generate-certificate', [StudentController::class, 'generateCertificate'])->name('students.generateCertificate');
    Route::get('/view-result', [StudentController::class, 'viewResult'])->name('students.viewResult');
    Route::post('/view-result', [StudentController::class, 'getResult'])->name('students.getResult');
    Route::post('/logout',[StudentController::class,'logout'])->name('students.logout');
}); 

Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/students', [AdminController::class, 'students'])->name('admin.students');
    Route::post('/students/add', [AdminController::class, 'addStudent'])->name('admin.students.add');
    Route::put('/students/edit/{id}', [AdminController::class, 'editStudent'])->name('students.update');
    Route::delete('/students/delete/{id}', [AdminController::class, 'deleteStudent'])->name('students.delete');

    Route::get('/subjects', [SubjectController::class, 'subjects'])->name('admin.subjects');
    Route::post('subjects/add', [SubjectController::class, 'addSubjects'])->name('subjects.add');
    Route::put('/subjects/edit/{id}', [SubjectController::class, 'editSubjects'])->name('subjects.update');
    Route::delete('/subjects/delete/{id}', [SubjectController::class, 'deleteSubjects'])->name('subjects.delete');
    Route::post('/subjects/academic-plans/add', [AcademicPlanController::class, 'addAcademicPlan'])->name('subjects.plans.add');
    Route::get('/subjects/academic-plans', [SubjectController::class, 'academicPlans'])->name('admin.academic-plans');

    Route::get('/registrations', [RegistrationController::class, 'registrations'])->name('admin.registrations');
    Route::post('/registrations/add', [RegistrationController::class, 'addRegistration'])->name('registration.add');
    Route::get('/academic-plans/subjects', [RegistrationController::class, 'getSubjectsByPlan'])->name('academic-plans.subjects');
    Route::delete('/registrations/delete/{id}', [RegisterController::class, 'deleteRegistration'])->name('registrations.delete');

    Route::get('/marks', [MarkController::class, 'marks'])->name('admin.marks');
    Route::post('/marks/add', [MarkController::class, 'addMarks'])->name('marks.add');
    Route::put('/marks/update/{id}', [MarkController::class, 'editMarks'])->name('marks.update');
    Route::delete('/marks/delete/{id}', [MarkController::class, 'deleteMarks'])->name('marks.delete');
});
