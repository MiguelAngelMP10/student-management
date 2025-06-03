<?php

use App\Http\Controllers\API\StudentController;
use Illuminate\Support\Facades\Route;

Route::prefix('students')->group(function () {
    Route::post('/', [StudentController::class, 'store']);
    Route::get('/', [StudentController::class, 'index']);
    Route::get('/{enrollmentNumber}', [StudentController::class, 'show']);
});
