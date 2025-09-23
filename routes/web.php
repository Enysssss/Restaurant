<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckIfAdmin;
use App\Http\Middleware\CheckIfConnected;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schedule;

// Home 
Route::get('/', function () {return view('home');})->middleware(CheckIfConnected::class)->name('home');

// create User
Route::get('creer', [UserController::class, 'index'])->middleware(CheckIfConnected::class)->name('form_user');
Route::post('creer', [UserController::class, 'store'])->name('create_user');

// Register
Route::get('login', [UserController::class, 'form_login'])->middleware(CheckIfConnected::class)->name('form_login');
Route::post('login', [UserController::class, 'login'])->name('login_user');

Route::get('dashboard', [DishController::class, 'dashboard'])->middleware('auth')->name('dashboard');

// Create Dish
Route::get('create_dish', [DishController::class, 'index'])->middleware(CheckIfAdmin::class)->name('form_dish');
Route::post('create_dish', [DishController::class, 'store'])->middleware(CheckIfAdmin::class)->name('create_dish');

// list Dish
Route::get('list_dishes', [DishController::class, 'list_dishes'])->name('list_dishes');

// list dish of a user
Route::get('liste_dishes_user', [DishController::class, 'liste_dishes_user'])->name('liste_dishes_user');

// Delete Dish
Route::delete('delete_dish/{id}', [DishController::class, 'destroy'])->name('delete_dish');

// Edit Dish
Route::get('/edit/{id}', [UserController::class, 'Edit_Dish'])->name('Edit_Dish');
Route::post('/edit/{id}', [UserController::class, 'edit'])->name('edit');

// Déconnection
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('form_login')->with('success', 'Déconnexion réussie');
})->name('logout');

// LIKE / DISLIKE A DISH
Route::post('/like/{id}', [UserController::class, 'like'])->name('like');
Route::delete('/unlike/{id}', [UserController::class, 'unlike'])->name('unlike');

// Les likes du user
Route::get('/MyLikes', [UserController::class, 'MyLikes'])->name('My_Likes');

Route::get('/Users_list', [UserController::class, 'Users_list'])->middleware(CheckIfAdmin::class)->name('Users_list');

// del a user
Route::delete('/Del_User/{id}', [UserController::class, 'Del_User'])->middleware(CheckIfAdmin::class)->name('Del_User');
Route::delete('/User_Admin/{id}', [UserController::class, 'User_Admin'])->middleware(CheckIfAdmin::class)->name('User_Admin');

Route::get('/Detail_Dish/{id}', [DishController::class, 'Detail_Dish'])->name('Detail_Dish');
Route::post('/Put_Comment/{id}', [DishController::class, 'Put_Comment'])->name('Put_Comment');

// ==================== POUBELLE =================================
// Route::get('/update_dish/{id}', [DishController::class, 'update'])->name('update_dish');
// Route::get('/c', function() {return view('create_dish');})->name('cd');
// Route::delete('Del_Dish',[DishController::class, 'Dele'])
// Schedule::command('app:netoyage-base')
//     ->everyFiveSeconds()
//     ->description("Destroy everyday les Users");
// Route::delete('/delete_dish/{dish}', [DishController::class, 'delete'])->name('dish.destroy');
//     Route::get('/list', function(){
//     return view('liste_dash');
// });
// Route::get('/co',[AuthController::class, 'index'])->name("auth1");
// Route::post('/co/post',[AuthController::class, 'index'])->name("auth2");
// Route::post('/like/{dish}', [DishController::class, 'like'])->name('dish.like');
// Route::get('/auth', function(){return view('auth');});
// Route::get('login', [UserController::class, 'formulaireDeConnection'])->name('form_login');

// ==================== RE USABLE=================
// Route::get('/DisLike/{id}', [UserController::class, 'DisLike'])->name('unlike.test');
// Route::get('delete_dish', [DishController::class, 'delete_dish'])->name('delete_dish');
