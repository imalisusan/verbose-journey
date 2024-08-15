<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Example API route
Route::get('/test', function (Request $request) {
    return response()->json([
        'success' => true,
        'message' => 'API route is working!',
    ]);
});
