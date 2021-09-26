<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [IndexController::class, 'employees'])->name('default');
Route::get('/employees', [IndexController::class, 'employees'])->name('all-employees-list');

Route::get('/employees/{department}', [IndexController::class, 'departmentEmployees'])
    ->whereNumber('department')
    ->name('department-employees');

Route::post('/upload-xml', [IndexController::class, 'uploadXML'])->name('upload-xml');
