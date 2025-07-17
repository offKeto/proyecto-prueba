<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GuzzleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Services\MailService;
use Illuminate\Support\Facades\Auth;

Route::controller(HomeController::class)->group(function () {
  Route::get('/', 'returnHomeView');
});
Route::controller(ContactController::class)->group(function () {
  Route::get('/contact', 'returnContactView');
  Route::post('/contact/send-mail', [MailService::class, 'sendMail']);
});
Route::controller(AboutController::class)->group(function () {
  Route::get('/about', 'returnAboutView');
});

Route::controller(TaskController::class)->group(function () {
  Route::get('/to-do-list', 'returnTaskView');
  Route::get('/to-do-list/tasks', 'returnAllTasks');
  Route::put('/to-do-list/tasks/status/{task}', 'updateStatus');
  Route::put('/to-do-list/tasks/{task}', 'updateTask');
  Route::get('/to-do-list/tasks/{task}', 'returnTask');
  Route::delete('/to-do-list/tasks/{task}', 'deleteTask');
  Route::post('/to-do-list/tasks', 'createTask');
});

Route::get('/fetchData', [GuzzleController::class, 'fetchData']);

Route::controller(AuthController::class)->group(function () {
  Route::get('/register', 'returnRegisterView');
  Route::get('/login', 'returnLoginView');
  Route::post('/register', 'handleRegister');
  Route::post('/login', 'handleLogin');
  Route::post('/logout', 'handleLogout')->name('logout');
});
