<?php

use App\Http\Controllers\DishController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckIfConnected;
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
Route::get('formDish', [DishController::class, 'formDish'])->name('formDish');
Route::post('createDish', [DishController::class, 'createDish'])->name('createDish');

// list Dish
Route::get('listDishes', [DishController::class, 'listDishes'])->name('listDishes');

// list dish of a user
Route::get('listUserDish', [DishController::class, 'listUserDish'])->name('listUserDish');

// Delete Dish
Route::delete('deleteDish/{id}', [DishController::class, 'destroy'])->name('deleteDish');

// Edit Dish
Route::get('/editDish/{id}', [UserController::class, 'editDish'])->name('editDish');
Route::post('/edit/{id}', [UserController::class, 'edit'])->name('edit');

// Déconnection
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('formLogin')->with('success', 'Déconnexion réussie');
})->name('logout');

// like & dislike un dish
Route::post('/like/{id}', [UserController::class, 'like'])->name('like');
Route::delete('/unlike/{id}', [UserController::class, 'unlike'])->name('unlike');

// Les likes du user
Route::get('/myLikes', [UserController::class, 'myLikes'])->name('myLikes');

//Liste des Utilisateurs 
Route::get('/userList', [UserController::class, 'userList'])->name('userList');

// del a user
Route::delete('/deleteUser/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');
Route::delete('/userBecomeAdmin/{id}', [UserController::class, 'userBecomeAdmin'])->name('userBecomeAdmin');

//detail d'un dish 
Route::get('/detailDish/{id}', [DishController::class, 'detailDish'])->name('detailDish');

//Commenter un plat 
Route::post('/putComment/{id}', [DishController::class, 'putComment'])->name('putComment');

Route::get('/deleteComment/{id}',[DishController::class, 'deleteComment'])->name('deleteComment'); 

Route::fallback(function() {return view('404'); });

Route::get('/test',[DishController::class, 'test'])->name('test'); 
