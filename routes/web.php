<?php

use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\StudentController;
// use App\Http\Controllers\ProductController;
// use App\Http\Controllers\EmployeController;


use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\MentorenController;
use App\Http\Controllers\ReserveringenController;
use App\Http\Controllers\UitleenGeschiedenisController;
use App\Http\Controllers\VoorwerpenController;
use App\Http\Controllers\KinderenController;


Route::get('/', function () {
    return view('login.login');
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
// Route::resource('categories', CategoriesController::class);

// Routes for Mentoren
// Route::resource('mentoren', MentorenController::class);
Route::get('/login', [MentorenController::class, 'showLoginForm'])->name('login');
Route::post('/login', [MentorenController::class, 'login']);
Route::post('/logout', [MentorenController::class, 'logout'])->name('logout');

// Routes for Reserveringen
// Route::resource('reserveringen', ReserveringenController::class);

// Routes for Uitleengeschiedenis
// Route::resource('uitleengeschiedenis', UitleengeschiedenisController::class);
// Route::post('/uitleengeschiedenis', [UitleengeschiedenisController::class, 'store'])->name('uitleengeschiedenis.store');
// Route::post('/uitleengeschiedenis/retour', [UitleenGeschiedenisController::class, 'retourUitgeleend'])->name('uitleengeschiedenis.retourUitgeleend');

// Routes for Voorwerpen
// Route::get('/voorwerpen/scan', [VoorwerpenController::class, 'scan'])->name('voorwerpen.scan');
// Route::resource('voorwerpen', VoorwerpenController::class);

// Route for the kinderen
// Route::resource('kinderen', KinderenController::class);
// Route::get('/kinderen/{id}/scan', [KinderenController::class, 'scan'])->name('kinderen.scan');


Route::middleware(['auth'])->group(function () {
    Route::get('/voorwerpen/scan', [VoorwerpenController::class, 'scan'])->name('voorwerpen.scan');
    Route::get('/voorwerpen/create', [VoorwerpenController::class, 'create'])->name('voorwerpen.create');
    Route::get('/voorwepen', [VoorwerpenController::class, 'index'])->name('voorwerpen');
    Route::post('/voorwerpen/reserveren/{uuid}', [VoorwerpenController::class, 'reserveren'])->name('voorwerpen.reserveren');
    Route::post('/voorwerpen/verwijderreservatie/{uuid}', [VoorwerpenController::class, 'removereservatie'])->name('voorwerpen.removereservatie');
    Route::resource('voorwerpen', VoorwerpenController::class);
    Route::get('/kinderen', [KinderenController::class, 'index'])->name('kinderen');
    Route::get('/kinderen/{id}/scan', [KinderenController::class, 'scan'])->name('kinderen.scan');
    Route::resource('kinderen', KinderenController::class);
    Route::get('/mentoren', [MentorenController::class, 'index'])->name('mentoren');
    Route::get('/mentoren/profile', [MentorenController::class, 'profile'])->name('mentoren.profile');
    Route::put('/mentoren/updateProfile', [MentorenController::class, 'updateProfile'])->name('Mentoren.updateProfile');
    Route::resource('mentoren', MentorenController::class);
    Route::resource('uitleengeschiedenis', UitleenGeschiedenisController::class);
    Route::post('/uitleengeschiedenis', [UitleenGeschiedenisController::class, 'store'])->name('uitleengeschiedenis.store');
    Route::post('/uitleengeschiedenis/retour', [UitleenGeschiedenisController::class, 'retourUitgeleend'])->name('uitleengeschiedenis.retourUitgeleend');
    Route::resource('reserveringen', ReserveringenController::class);
    Route::resource('categories', CategoriesController::class);
}); 