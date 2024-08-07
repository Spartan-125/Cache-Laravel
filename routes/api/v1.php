<?php

use App\Http\Controllers\User\v1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function(){
    Route::controller(UserController::class)->prefix('user')->group(function(){
        Route::prefix('match')->group(function(){
            Route::get('all', 'index');
            Route::get('one', 'oneUser')->middleware('user.cache');
        });
        Route::prefix('redis')->group(function(){
            Route::get('all', 'indexTwo');
            Route::get('one', 'oneUserTwo');
        });
    });
});

