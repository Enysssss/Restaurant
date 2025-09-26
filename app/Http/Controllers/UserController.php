<?php

namespace App\Http\Controllers;

use App\Mail\UserMail;
use App\Models\Dish;
use App\Models\User;
use App\Models\Comment;
use App\Models\DishUser;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        return view('Register');
    }

    public function formLogin()
    {
        return view('connection');
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required',
        ]);

        $user = User::where('name', $request->username)->exists();

        if ($user) {
             return back()->withErrors(['username' => 'Utilisateur existe déjà, veillez choisir un autre nom d\'utilisateur !'])->withInput();
          }

        $user = new User;
        $user->name = $request->username;
        $user->email = strtolower($request->username).'@example.com';
        $user->password = Hash::make($request->password);
        $user->save();

        Mail::to($user->email)->send(new UserMail($user));

        return redirect()->route('formLogin')->with('succes', 'Inscription Réalisée !');
    }

    public function login(Request $request)
    {

        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('name', $request->username)->first();

        if (! $user) {
            return back()->withErrors(['username' => 'User non trouvé'])->withInput();
        }

        if (! Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'MDP incorrect'])->withInput();
        }

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Connexion Réalisée !');

    }

    public function like($id)
    {
        $user = Auth::User();
        $dish = Dish::find($id);
       // $dish->likedBy()->attach($user->id);
        DishUser::firstOrCreate([
            'user_id' => $user->id,
            'dish_id' => $dish->id,
        ]);


        return back();
    }

    public function unlike($id)
    {
        $user = Auth::User();
        $dish = Dish::find($id);
        // $dish->likedByUsers()->detach($user->id);
        DishUser::where('user_id', $user->id)
                ->where('dish_id', $dish->id)
                ->delete();
        return back();
    }

    public function myLikes()
    {
        $UserNow = Auth::user();
        $user = User::find($UserNow->id);
        $dishes = $user->likes()->get();

        return view('liked_dishes', compact('dishes'));

    }

    public function editDish($id)
    {
        $dish = Dish::find($id);

        return view('edit_dishes', compact('dish'));
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string',
            'description' => 'nullable|string|max:2048',
        ]);

        $dish = Dish::find($id);
        $dish->name = $request->name;
        $dish->description = $request->description;
        $dish->save();

        return redirect()->route('listUserDish')->with('success', 'Plat modifier !');
    }

    public function userList()
    {
        $Users = User::all();
        return view('Users_list', compact('Users')); 
    }

    public function deleteUser($id)
    {
        $user = User::find($id); 
        $user->dishes()->delete();
        dd($user->likedDishes);//()->delete(); 
        $user->comments()->delete();
    //    $user-> delete();
       
  //      return back()->with('success', 'User delete');

    }

    public function userBecomeAdmin($id)
    {
        $user = User::find($id);
        
        if ($user->hasRole('admin')) {
            $user->removeRole('admin');
        } else {
            $user->assignRole('admin');
        }

        return back();
    }
}
