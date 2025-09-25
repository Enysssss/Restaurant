<?php

use App\Http\Controllers\DishController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckIfConnected;
use App\Http\Middleware\CheckIfNotConnected;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Home 
Route::get('/', function () {return view('home');})->middleware(CheckIfConnected::class)->name('home');

// create User
Route::get('formUser', [UserController::class, 'index'])->middleware(CheckIfConnected::class)->name('formUser');
Route::post('createUser', [UserController::class, 'createUser'])->name('createUser');

// Register
Route::get('login', [UserController::class, 'formLogin'])->middleware(CheckIfConnected::class)->name('formLogin');
Route::post('login', [UserController::class, 'login'])->name('loginUser');

Route::get('dashboard', [DishController::class, 'dashboard'])->middleware('auth')->name('dashboard');

// Create Dish
Route::get('formDish', [DishController::class, 'formDish'])->middleware(CheckIfNotConnected::class)->name('formDish');
Route::post('createDish', [DishController::class, 'createDish'])->middleware(CheckIfNotConnected::class)->name('createDish');

// list Dish
Route::get('listDishes', [DishController::class, 'listDishes'])->middleware(CheckIfNotConnected::class)->name('listDishes');

// list dish of a user
Route::get('listUserDish', [DishController::class, 'listUserDish'])->middleware(CheckIfNotConnected::class)->name('listUserDish');

// Delete Dish
Route::delete('deleteDish/{id}', [DishController::class, 'destroy'])->middleware(CheckIfNotConnected::class)->name('deleteDish');

// Edit Dish
Route::get('/editDish/{id}', [UserController::class, 'editDish'])->middleware(CheckIfNotConnected::class)->name('editDish');
Route::post('/edit/{id}', [UserController::class, 'edit'])->middleware(CheckIfNotConnected::class)->name('edit');

// Déconnection
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('formLogin')->with('success', 'Déconnexion réussie');
})->name('logout');

// like & dislike un dish
Route::post('/like/{id}', [UserController::class, 'like'])->middleware(CheckIfNotConnected::class)->name('like');
Route::delete('/unlike/{id}', [UserController::class, 'unlike'])->middleware(CheckIfNotConnected::class)->name('unlike');

// Les likes du user
Route::get('/myLikes', [UserController::class, 'myLikes'])->middleware(CheckIfNotConnected::class)->name('myLikes');

//Liste des Utilisateurs 
Route::get('/userList', [UserController::class, 'userList'])->middleware(CheckIfNotConnected::class)->name('userList');

// del a user
Route::delete('/deleteUser/{id}', [UserController::class, 'deleteUser'])->middleware(CheckIfNotConnected::class)->name('deleteUser');
Route::delete('/userBecomeAdmin/{id}', [UserController::class, 'userBecomeAdmin'])->middleware(CheckIfNotConnected::class)->name('userBecomeAdmin');

//detail d'un dish 
Route::get('/detailDish/{id}', [DishController::class, 'detailDish'])->middleware(CheckIfNotConnected::class)->name('detailDish');

//Commenter un plat 
Route::post('/putComment/{id}', [DishController::class, 'putComment'])->middleware(CheckIfNotConnected::class)->name('putComment');

Route::delete('/deleteComment/{id}',[DishController::class, 'deleteComment'])->middleware(CheckIfNotConnected::class)->name('deleteComment'); 

Route::fallback(function() {return view('404'); });

Route::get('/test',[DishController::class, 'test'])->name('test'); 
