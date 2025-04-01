<?php

use App\Http\Controllers\TodoListController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::prefix('todo-list')->group(function () {
    Route::get('/', [TodoListController::class, 'index'])->name('todo-list.index');
    Route::get('show/{id}', [TodoListController::class, 'show'])->name('todo-list.show');
    Route::post('store', [TodoListController::class, 'store'])->name('todo-list.store');
    Route::patch('update/{id}', [TodoListController::class, 'update'])->name('todo-list.update');
    Route::delete('destroy/{id}', [TodoListController::class, 'destroy'])->name('todo-list.destroy');
});


Route::prefix('todo-list-tasks')->group(function () {
    Route::get('/{todo_list_id}', [TaskController::class, 'index'])->name('task.index');
    Route::get('show/{id}', [TaskController::class, 'show'])->name('task.show');
    Route::post('store', [TaskController::class, 'store'])->name('task.store');
    Route::patch('update/{id}', [TaskController::class, 'update'])->name('task.update');
    Route::delete('destroy/{id}', [TaskController::class, 'destroy'])->name('task.destroy');
    Route::patch('change_status/{id}', [TaskController::class, 'changeStatus'])->name('task.change_status');
});


Route::post('/register', [AuthController::class, 'register'])->name('user.register');
Route::post('/login', [AuthController::class, 'login'])->name('user.login');
