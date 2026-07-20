<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FolderController;
use App\Models\Document;
use App\Models\Employee;
use App\Models\Folder;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return view('dashboard', [

        'employees' => Employee::count(),

        'folders' => Folder::count(),

        'documents' => Document::count(),

//        'departments' => Department::count(),


        'latestEmployees' => Employee::latest()
            ->take(5)
            ->get(),


        'latestFolders' => Folder::with('employee')
            ->latest()
            ->take(5)
            ->get(),

    ]);

})->name('dashboard');

Route::get('/folders', [FolderController::class, 'index'])
    ->name('folder.index');


Route::get('/folders/{folder}', [FolderController::class, 'show'])
    ->name('folders.show');



// Employees
Route::get('/employees', [EmployeeController::class, 'index'])
    ->name('employee.index');

Route::get('/abouts', function () {

    return view('abouts');

})->name('abouts');
