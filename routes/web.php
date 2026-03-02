<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Teacher\AttendanceController;
use App\Http\Controllers\Admin\TeacherAttendanceController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminTeacherController;
use App\Models\User; // put this at the very top of web.php, under other "use" lines
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // If user is already logged in, send them to their dashboard
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    // Otherwise show login page
    return redirect()->route('login');
});

// After login, redirect based on role
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('teacher.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



// TEMP route – remove after running once!
Route::get('/create-first-admin', function () {
    // safety: don't create duplicate if it already exists
    if (User::where('email', 'ouissalw0@gmail.com')->exists()) {
        return 'Admin already exists.';
    }

    User::create([
        'name'     => 'Ouissal BOURAS',
        'email'    => 'ouissalw0@gmail.com',
        'password' => bcrypt('ninja02'), // you can change this password
        'role'     => 'admin',
    ]);

    return 'Admin user created successfully!';
});

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {

    // ADMIN DASHBOARD
    Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    // Students CRUD
    Route::resource('admin/students', StudentController::class)
        ->names('admin.students')
        ->parameters(['students' => 'student']);

    // Groups CRUD
    Route::resource('admin/groups', GroupController::class)
        ->names('admin.groups')
        ->parameters(['groups' => 'group']);

    // Admin can log teacher attendance
    Route::get('admin/teacher-attendance', [TeacherAttendanceController::class, 'index'])
        ->name('admin.teacher-attendance.index');

    Route::post('admin/teacher-attendance', [TeacherAttendanceController::class, 'store'])
        ->name('admin.teacher-attendance.store');

    // Admin registers teachers
    Route::resource('admin/teachers', AdminTeacherController::class)
        ->names('admin.teachers')
        ->parameters(['teachers' => 'teacher']);
});

//Admin can log teacherattendence
Route::get('admin/teacher-attendance', [TeacherAttendanceController::class, 'index'])
    ->name('admin.teacher-attendance.index');

Route::post('admin/teacher-attendance', [TeacherAttendanceController::class, 'store'])
    ->name('admin.teacher-attendance.store');


// Teacher routes
Route::middleware(['auth', 'teacher'])->group(function () {
    Route::get('/teacher', [AttendanceController::class, 'index'])
        ->name('teacher.dashboard');

    Route::get('/teacher/groups/{group}/{date?}', [AttendanceController::class, 'show'])
        ->name('teacher.groups.show');

    Route::post('/teacher/groups/{group}', [AttendanceController::class, 'store'])
        ->name('teacher.groups.store');
});

// Profile routes (Breeze default)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Auth routes (login, register, logout, etc.)
require __DIR__.'/auth.php';