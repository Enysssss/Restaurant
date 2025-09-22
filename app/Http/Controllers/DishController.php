<?php

namespace App\Http\Controllers;

use App\Http\Requests\DishStoreRequest;
use App\Mail\DishMail;
use App\Models\Dish;
use App\Models\User;

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
        $plats = Dish::select('name', 'description', 'image', 'id')->paginate(9);
        
        $UserNow = Auth::user();
        $user = User::find($UserNow->id);
        $Dish_Liked = $user->dishes()->pluck('dishes.id')->toArray();

        $platsLiked = [];
        foreach ($plats as $plat) {
            $platsLiked[$plat->id] = in_array($plat->id, $Dish_Liked);
        }
        return view('list_dishes', compact('plats','platsLiked'));
    }

    public function store(DishStoreRequest $request)
    {

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
        $plats = Dish::select('name', 'description', 'image', 'id')->where('user_id', $id) ->paginate(9);

        return view('list_dishes_user', compact('plats'));
    }

    public function dashboard()
    {
        $NB_Dishes = Dish::count();
        $NB_client = User::count();
        $userCO = Auth::user(); 
        $user = User::find($userCO->id); 
        $NB_MY_DISHES = $user->dishes()->count();
        if($NB_MY_DISHES == 0){
            $NB_MY_likes = 0; 
        }else{
            //$NB_MY_likes = $user->likedDishes()->count();
        }
        return view(('dashboard'), compact('NB_Dishes', 'NB_client' ,'NB_MY_DISHES')); //,'NB_MY_likes'
    }

}
