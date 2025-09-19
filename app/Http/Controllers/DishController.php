<?php

namespace App\Http\Controllers;

use App\Mail\DishMail;
use App\Models\Dish;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DishController extends Controller
{
    public function index()
    {
        return view('create_dish');
    }

    public function list_dishes()
    {
        $plats = Dish::select('name', 'description', 'image', 'id')->paginate(3);

        return view('list_dishes', compact('plats'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string|max:2048',
            'image' => 'required|image',
        ]);

        $user = Auth::User();
        $imagePath = $request->file('image')->store('uploads', 'public'); // X

        $dish = new Dish;
        $dish->name = $request->name;
        $dish->description = $request->description;
        $dish->image = $imagePath;
        $dish->user_id = $user->id;
        $dish->save();
        Mail::to($user->email)->send(new DishMail($user));

        return redirect()->route('list_dishes')->with('succes', 'Inscription réussie ! + Mail Send');
    }

    public function destroy($id)
    {
        $dish = Dish::where('id', $id);
        $dish->delete();

        return back();
    }

    public function liste_dishes_user()
    {
        $userConnected = Auth::user();
        $id = $userConnected->id;
        $plats = Dish::select('name', 'description', 'image', 'id')->where('user_id', $id)->get();

        return view('list_dishes_user', compact('plats'));
    }
}

