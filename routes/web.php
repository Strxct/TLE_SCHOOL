<?php

use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\StudentController;
// use App\Http\Controllers\ProductController;
// use App\Http\Controllers\EmployeController;


use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\MentorenController;
use App\Http\Controllers\ReserveringenController;
use App\Http\Controllers\UitleengeschiedenisController;
use App\Http\Controllers\VoorwerpenController;
use App\Http\Controllers\KinderenController;


Route::get('/', function () {
    return view('layout.index');
})->name('home');

// // student routes
// Route::get('/students', [StudentController::class, 'index'])->name('student.index');
// Route::get('/students/create', [StudentController::class, 'create'])->name('student.create');
// Route::post('/students/create', [StudentController::class, 'store'])->name('student.store');

// Route::get('/students/{id}', [StudentController::class, 'edit'])->name('student.edit');
// Route::put('/students/{id}', [StudentController::class, 'update'])->name('student.update');
// Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('student.destroy');
// Route::get('/students/view/{id}', [StudentController::class, 'show'])->name('student.show');

// // product routes
// Route::resource('products', ProductController::class);

// //employe routes
// Route::resource('employes', EmployeController::class);


// Routes for Categories
Route::resource('categories', CategoriesController::class);

// Routes for Mentoren
Route::resource('mentoren', MentorenController::class);
Route::get('/login', [MentorenController::class, 'showLoginForm'])->name('login');
Route::post('/login', [MentorenController::class, 'login']);
Route::post('/logout', [MentorenController::class, 'logout'])->name('logout');

// Routes for Reserveringen
Route::resource('reserveringen', ReserveringenController::class);

// Routes for Uitleengeschiedenis
Route::resource('uitleengeschiedenis', UitleengeschiedenisController::class);

// Routes for Voorwerpen
Route::resource('voorwerpen', VoorwerpenController::class);

// Route for the kinderen
Route::resource('kinderen', KinderenController::class);


Route::middleware(['auth'])->group(function () {
    Route::get('/voorwepen', [VoorwerpenController::class, 'index'])->name('voorwerpen');
    Route::resource('voorwerpen', VoorwerpenController::class);
});