<?php
/* Auth Routes */
Route::group([ 'prefix' => 'auth' ], function() {
    Route::post('login', [App\Http\Controllers\Auth\AuthController::class, 'login']);
    Route::post('forgot', [App\Http\Controllers\Auth\ResetController::class, 'forgot']);
    Route::post('change-password', [App\Http\Controllers\Auth\ResetController::class, 'changePassword']);
});

Route::group(['middleware' => ['jwt.auth']], function () {
    /* Auth jwt protected routes */
    Route::group([ 'prefix' => 'auth' ], function() {
        Route::post('logout', [App\Http\Controllers\Auth\AuthController::class, 'logout']);
        Route::post('refresh', [App\Http\Controllers\Auth\AuthController::class, 'refresh']);
    });

    /* User routes */
    Route::get('me', [App\Http\Controllers\UserController::class, 'show']);

    /* Dashboard route */
    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
});
