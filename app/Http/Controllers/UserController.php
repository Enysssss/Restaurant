<?php

namespace App\Http\Controllers;

use App\Mail\UserMail;
use App\Models\Dish;
use App\Models\User;
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

    public function form_login()
    {
        return view('connection');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required',
        ]);

        $user = new User;
        $user->name = $request->username;
        $user->email = strtolower($request->username).'@example.com';
        $user->password = Hash::make($request->password);
        $user->save();

        Mail::to($user->email)->send(new UserMail($user));

        return redirect()->route('form_login')->with('succes', 'Inscription Réalisée !');
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
        $dish->users()->attach($user->id);

        return back();
    }

    public function unlike($id)
    {
        $user = Auth::User();
        $dish = Dish::find($id);
        $dish->users()->detach($user->id);

        return back();
    }

    public function myLikes()
    {
        $UserNow = Auth::user();
        $user = User::find($UserNow->id); 
        $dishes = $user->dishes()->get();

        return view('liked_dishes', compact('dishes'));

    }

    public function Edit_Dish($id)
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

        return redirect()->route('liste_dishes_user')->with('success', 'Plat modifier !');
    }
}

