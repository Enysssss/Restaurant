<?php

use App\Http\Controllers\DishController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckIfConnected;
use App\Http\Middleware\CheckIfNotConnected;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware([CheckIfConnected::class])->group(function () {
    // Home 
    Route::get('/', function () {return view('home');})->name('home');

    // Creer un utilisateur
    Route::get('formUser', [UserController::class, 'index'])->name('formUser');
    Route::post('createUser', [UserController::class, 'createUser'])->name('createUser');

    // Connection
    Route::get('login', [UserController::class, 'formLogin'])->name('formLogin');
    Route::post('login', [UserController::class, 'login'])->name('loginUser');
});

Route::middleware([CheckIfNotConnected::class])->group(function () {
    // Créer un plat
    Route::get('formDish', [DishController::class, 'formDish'])->name('formDish');
    Route::post('createDish', [DishController::class, 'createDish'])->name('createDish');

    // Liste des plats 
    Route::get('listDishes', [DishController::class, 'listDishes'])->name('listDishes');

    // Liste des plat d'un tilisateur
    Route::get('listUserDish', [DishController::class, 'listUserDish'])->name('listUserDish');

    // Supprimer un plat
    Route::delete('deleteDish/{id}', [DishController::class, 'deleteDish'])->name('deleteDish');

    // Modifier un plat
    Route::get('/editDish/{id}', [UserController::class, 'editDish'])->name('editDish');
    Route::post('/edit/{id}', [UserController::class, 'edit'])->name('edit');

    // Like & dislike a dish
    Route::post('/like/{id}', [UserController::class, 'like'])->name('like');
    Route::delete('/unlike/{id}', [UserController::class, 'unlike'])->name('unlike');

    // Les likes de l'utilisateur
    Route::get('/myLikes', [UserController::class, 'myLikes'])->name('myLikes');

    // Liste des Utilisateurs 
    Route::get('/userList', [UserController::class, 'userList'])->name('userList');

    // Supprimer un utilisateur
    Route::delete('/deleteUser/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');
    Route::delete('/userBecomeAdmin/{id}', [UserController::class, 'userBecomeAdmin'])->name('userBecomeAdmin');

    // Detail d'un plat 
    Route::get('/detailDish/{id}', [DishController::class, 'detailDish'])->name('detailDish');

    // Commenter un plat 
    Route::post('/putComment/{id}', [DishController::class, 'putComment'])->name('putComment');

    Route::delete('/deleteComment/{id}',[DishController::class, 'deleteComment'])->name('deleteComment');
});

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('dashboard', [DishController::class, 'dashboard'])->name('dashboard');
});

// Déconnexion
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('formLogin')->with('success', 'Déconnexion réussie');
})->name('logout');

// 404
Route::fallback(function() { return view('404'); });

// Route de test
Route::get('/test',[DishController::class, 'trySpe'])->name('test');
