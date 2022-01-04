<?php

use Warehouse\Controller\AuthController;
use Warehouse\Controller\LoginController;
use Warehouse\Controller\PositionController;
use Warehouse\Controller\RegisterController;
use Warehouse\Controller\UserController;
use Warehouse\Route\Route;

Route::get("/register", [RegisterController::class, 'showRegisterForm']);
Route::post("/register", [RegisterController::class, 'register']);
Route::get("/account", [UserController::class, 'accaunt']);
Route::get("/login", [LoginController::class, 'showLoginForm']);
Route::post("/login", [LoginController::class, 'login']);
Route::get("/users/get-by-name", [UserController::class, 'getByName']);
Route::get("/users", [UserController::class, 'all']);
Route::get("/users/create", [UserController::class, 'showCreateForm']);
Route::post("/users/save", [UserController::class, 'saveUser']);
Route::post("/users/delete", [UserController::class, 'delete']);
Route::post("/json/data/users-delete", [UserController::class, 'ajaxDelete']);
Route::post("/json/data/users-create", [UserController::class, 'ajaxCreate']);
Route::get("/json/data/users-show", [UserController::class, 'showUserAjax']);
Route::get("/json/data", [UserController::class, 'json_data']);
Route::get("/ajax-view", [UserController::class, 'showAjaxPage']);
Route::get('/positions',[PositionController::class, 'all']);
Route::get('/positions/show',[PositionController::class, 'byId']);
Route::get('/positions/createForm',[PositionController::class, 'createForm']);
Route::post('/positions/create',[PositionController::class, 'create']);
Route::get('/positions/delete',[PositionController::class, 'delete']);
Route::get('/positions/updateForm',[PositionController::class, 'updateForm']);
Route::post('/positions/update',[PositionController::class, 'update']);