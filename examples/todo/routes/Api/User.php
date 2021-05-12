<?php
use Illuminate\Support\Facades\Route;

//use
use App\Http\Controllers\Api\User\CreateUserController;
//route
Route::match(array('POST'), 'user/create', ['uses' => CreateUserController::class])->middleware(['jwt.verify']);
