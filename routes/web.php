<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::post('/dashboard/customer/sort',[CustomerController::class,'sort'])->middleware('auth')->name('customer.sort');
Route::get('/dashboard/customer/trash',[CustomerController::class,'trash'])->middleware('auth')->name('customer.trash');
Route::delete('/dashboard/customer/trash/{customer}',[CustomerController::class,'forcedelete'])->middleware('auth')->name('customer.forcedelete');
Route::get('/dashboard/customer/trash/{customer}',[CustomerController::class,'restore'])->middleware('auth')->name('customer.restore');

Route::resource('dashboard/customer',CustomerController::class);
