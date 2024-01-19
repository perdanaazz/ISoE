<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeePhotoController;
use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return redirect()->route('employee.index');
});

Route::resource('/employee', EmployeeController::class);
Route::post('upload', [EmployeePhotoController::class, 'photoUpload'])->name('photo-upload');
Route::delete('upload/{filename}', [EmployeePhotoController::class, 'photoDelete'])->name('photo-delete');
