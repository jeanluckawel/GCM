<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GlobalSearchController;
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

Route::get('/folders/create', [FolderController::class, 'create'])
    ->name('folder.create');

Route::get('/folders/documents/create', [FolderController::class, 'createDocument'])
    ->name('folder.document.create');

Route::get('/folders/{folder}', [FolderController::class, 'show'])
    ->whereNumber('folder')
    ->name('folders.show');



// Employees
Route::get('/employees', [EmployeeController::class, 'index'])
    ->name('employee.index');

Route::get('/employees/create', [EmployeeController::class, 'create'])
    ->name('employee.create');

Route::post('/employees', [EmployeeController::class, 'store'])
    ->name('employee.store');

Route::get('/employees/{employee}', [EmployeeController::class, 'show'])
    ->whereNumber('employee')
    ->name('employee.show');

Route::get('/employees/search', [EmployeeController::class, 'search'])
    ->name('employees.search');

Route::get('/search/global', [GlobalSearchController::class, 'index'])
    ->name('search.global');

Route::post('/folders', [FolderController::class, 'store'])
    ->name('folder.store');

Route::post('/folders/documents', [FolderController::class, 'storeDocument'])
    ->name('folder.document.store');

Route::get('/abouts', function () {

    return view('abouts');

})->name('abouts');
