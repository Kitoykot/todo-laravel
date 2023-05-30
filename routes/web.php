<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\TasksCotroller;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [PagesController::class, 'main'])->name('main');

//добавить задание
Route::post('/add-task', [TasksCotroller::class, 'addTask'])->name('add-task');

Route::get('/my-tasks', [PagesController::class, 'myTasks'])->name('my-tasks');
Route::get('/common-tasks', [PagesController::class, 'commonTasks'])->name('common-tasks');

//делать задание не_публичным
Route::post('/public-task', [TasksCotroller::class, 'publicTask'])->name('public-task');

Route::get('/update-task/{id}', [PagesController::class, 'updateTask'])->name('update-task');

//обновить и удалить задание
Route::post('/update', [TasksCotroller::class, 'updateTask'])->name('update');
Route::post('/delete', [TasksCotroller::class, 'deleteTask'])->name('delete');

Route::get('/one-task/{id}', [PagesController::class, 'oneTask'])->name('one-task');

//Обновить и удалить изображение
Route::post('/update-image', [TasksCotroller::class, 'updateImage'])->name('update-image');
Route::post('/delete-image', [TasksCotroller::class, 'deleteImage'])->name('delete-image');