<?php

use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\EmployeePhotoController;
use Illuminate\Support\Facades\Route;

Route::prefix('employee')->group(function () {
    Route::get('/list', [EmployeeController::class, 'list']);
    Route::post('/', [EmployeeController::class, 'store']);
    Route::put('/{employee_id}', [EmployeeController::class, 'update']);
    Route::delete('/{employee_id}', [EmployeeController::class, 'destroy']);
    
    // API for Upload
    Route::post('upload', [EmployeePhotoController::class, 'photoUpload'])->name('photo-upload');
    Route::delete('upload/{filename}', [EmployeePhotoController::class, 'photoDelete'])->name('photo-delete');
});
