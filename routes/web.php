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


Route::get('/', function(){
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
Route::get('/mentoren', [MentorenController::class, 'index'])->name('mentoren.index');
Route::get('/mentoren/create', [MentorenController::class, 'create'])->name('mentoren.create');
Route::post('/mentoren/create', [MentorenController::class, 'store'])->name('mentoren.store');
Route::get('/mentoren/{id}', [MentorenController::class, 'edit'])->name('mentoren.edit');
Route::put('/mentoren/{id}', [MentorenController::class, 'update'])->name('mentoren.update');
Route::delete('/mentoren/{id}', [MentorenController::class, 'destroy'])->name('mentoren.destroy');
Route::get('/mentoren/view/{id}', [MentorenController::class, 'show'])->name('mentoren.show');

// Routes for Reserveringen
Route::resource('reserveringen', ReserveringenController::class);
Route::get('/reserveringen', [ReserveringenController::class, 'index'])->name('reserveringen.index');
Route::get('/reserveringen/create', [ReserveringenController::class, 'create'])->name('reserveringen.create');
Route::post('/reserveringen/create', [ReserveringenController::class, 'store'])->name('reserveringen.store');
Route::get('/reserveringen/{id}', [ReserveringenController::class, 'edit'])->name('reserveringen.edit');
Route::put('/reserveringen/{id}', [ReserveringenController::class, 'update'])->name('reserveringen.update');
Route::delete('/reserveringen/{id}', [ReserveringenController::class, 'destroy'])->name('reserveringen.destroy');
Route::get('/reserveringen/view/{id}', [ReserveringenController::class, 'show'])->name('reserveringen.show');

// Routes for Uitleengeschiedenis
Route::resource('uitleengeschiedenis', UitleengeschiedenisController::class);

// Routes for Voorwerpen
Route::resource('voorwerpen', VoorwerpenController::class);
Route::get('/voorwerpen', [VoorwerpenController::class, 'index'])->name('voorwerpen.index');
Route::get('/voorwerpen/create', [VoorwerpenController::class, 'create'])->name('voorwerpen.create');
Route::post('/voorwerpen/create', [VoorwerpenController::class, 'store'])->name('voorwerpen.store');
Route::get('/voorwerpen/{id}', [VoorwerpenController::class, 'edit'])->name('voorwerpen.edit');
Route::put('/voorwerpen/{id}', [VoorwerpenController::class, 'update'])->name('voorwerpen.update');
Route::delete('/voorwerpen/{id}', [VoorwerpenController::class, 'destroy'])->name('voorwerpen.destroy');
Route::get('/voorwerpen/view/{id}', [VoorwerpenController::class, 'show'])->name('voorwerpen.show');

// Route for the kinderen
Route::resource('kinderen', KinderenController::class);
Route::get('/kinderen', [KinderenController::class, 'index'])->name('kinderen.index');
Route::get('/kinderen/create', [KinderenController::class, 'create'])->name('kinderen.create');
Route::post('/kinderen/create', [KinderenController::class, 'store'])->name('kinderen.store');
Route::get('/kinderen/{id}', [KinderenController::class, 'edit'])->name('kinderen.edit');
Route::put('/kinderen/{id}', [KinderenController::class, 'update'])->name('kinderen.update');
Route::delete('/kinderen/{id}', [KinderenController::class, 'destroy'])->name('kinderen.destroy');
Route::get('/kinderen/view/{id}', [KinderenController::class, 'show'])->name('kinderen.show');