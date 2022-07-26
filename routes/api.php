<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([],function () {
    Route::prefix("auth")->group(function () {
        Route::post("login", [\App\Http\Controllers\Api\Auth\LoginController::class,"login"]);
    });

    Route::group(["middleware"=>"auth:api"],function () {
        Route::resource("/students",\App\Http\Controllers\Api\StudentController::class);
    });

});
