<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UploadController;

Route::post('/upload', [UploadController::class, 'store']);
