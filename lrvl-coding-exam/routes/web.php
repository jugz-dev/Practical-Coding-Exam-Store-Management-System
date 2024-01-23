<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\EmployeeController;

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

// Apply the PreventCaching middleware to all routes in this group


Route::get('/', function () {
    return view('welcome');
})->name('home');
    

// Store Controller
Route::controller(StoreController::class)->group(function(){
    Route::get('/store',  'index')->name('store.index');
    Route::get('/store/create', 'create')->name('store.create');
    Route::post('/store/save', 'store')->name('store.save');
    Route::match(['get', 'post'], '/store/edit/{id}', 'edit')->name('store.edit');
    Route::post('/store/update/{id}', 'update')->name('store.update');
    Route::post('/store/delete/{id}', 'delete')->name('store.delete');
});
    
 
// Employee Controller   
Route::controller(EmployeeController::class)->group(function(){
    Route::get('/employee', 'index')->name('employee.index');
    Route::get('/employee/create','create')->name('employee.create');
    Route::post('/employee/save','store')->name('employee.save');
    Route::match(['get', 'post'], '/employee/edit/{id}','edit')->name('employee.edit');
    Route::post('/employee/update/{id}','update')->name('employee.update');
    Route::post('/employee/delete/{id}','delete')->name('employee.delete');
});



