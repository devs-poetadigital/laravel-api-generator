<?php
use Illuminate\Support\Facades\Route;

//use
use App\Http\Controllers\Api\User\SearchUserController;

use App\Http\Controllers\Api\User\UpdateUserController;

use App\Http\Controllers\Api\User\CreateUserController;
//route
Route::match(array('POST', 'GET'), 'user/search', ['uses' => SearchUserController::class])->middleware(['jwt.verify']);

Route::match(array('POST', 'PUT'), 'user/update', ['uses' => UpdateUserController::class])->middleware(['jwt.verify']);

Route::match(array('POST'), 'user/create', ['uses' => CreateUserController::class])->middleware(['jwt.verify']);
