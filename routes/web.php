<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\UrlController;
Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [CompanyController::class, 'create'])->middleware(['auth', 'verified'])->name('dashboard');



Route::get('/add-new-person', [PersonController::class, 'create'])
    ->middleware(['auth', 'verified' , 'role:superadmin,Admin'])
    ->name('add-new-person');

    //add new person
Route::post('persons', [PersonController::class, 'store'])
    ->name('persons.store');

Route::post('companies', [CompanyController::class, 'store'])
    ->name('companies.store');

//add new company
Route::get('/add-new-company', function () {
    return view('add-new-company');
})->middleware(['auth', 'verified', 'role:superadmin'])->name('add-new-company');

//generate url route
Route::get('/generate-url', function () {
    return view('generate-url');
})->middleware(['auth', 'verified', 'role:Admin,Member'])->name('generate-url');

//create short url 
Route::post('/urls/store', [UrlController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('urls.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//verify routs for short url
Route::get('/s/{short_code}', [UrlController::class, 'redirect'])->name('shorturl.redirect');

require __DIR__.'/auth.php';
