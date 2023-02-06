<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {

    return  $request->user();

});

Route::controller(AuthController::class)->group(function()
{
    Route::post('/login' , 'login');
    Route::post('/register' , 'register');
    Route::post('/logout' ,'logout')->middleware('auth:sanctum');

});

Route::middleware('auth:sanctum')->group(function(){

    Route::get("/departments/{id}/positions" , [DepartmentController::class , 'positions']);
    Route::apiResource('departments' , DepartmentController::class);
    Route::apiResource('positions', PositionController::class);
    Route::apiResource('employees', EmployeeController::class);

});

