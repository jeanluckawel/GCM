<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FolderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/folders', [FolderController::class, 'index'])
    ->name('folder.index');


Route::get('/folders/{folder}', [FolderController::class, 'show'])
    ->name('folders.show');



// Employees
Route::get('/employees', [EmployeeController::class, 'index'])
    ->name('employee.index');
