<?php

use Illuminate\Support\Facades\Route;

Route::get('/hello', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Hello World API berhasil dibuat'
    ]);
});