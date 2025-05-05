<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AdminController;

Route::post('register', [AuthController::class,'register']);
Route::post('login',    [AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', fn(Request $r)=> $r->user());
    Route::apiResource('tasks', TaskController::class);
    Route::post('tasks/reorder', [TaskController::class,'reorder']);

    Route::middleware('check.admin')->get('admin/users-tasks', [AdminController::class,'index']);
});