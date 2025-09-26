<?php

namespace App\Http\Controllers;

use App\Http\Requests\DishStoreRequest;
use Illuminate\Http\Request;
use App\Mail\DishMail;
use App\Models\Dish;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class DishController extends Controller
{
    public function formDish()
    {
        return view('create_dish');
    }

    public function listDishes()
    {
        $UserNow = Auth::user();
        $user = User::find($UserNow->id);

        $plats = Dish::select('name', 'description', 'image', 'id')->paginate(9);
        $Dish_Liked = $user->likes()->pluck('dish_id')->toArray();
        
        $nbLikes = [];
        $platsLiked = []; 
        foreach ($plats as $plat) {
            $platsLiked[$plat->id] = in_array($plat->id, $Dish_Liked);
            $nbLikes[$plat->id] = $plat->likedBy->count(); 
        }

        return view('list_dishes', compact('plats', 'platsLiked','nbLikes'));
    }

    public function createDish(DishStoreRequest $request)
    {

        $user = Auth::User();

        $dish = new Dish;
        $dish->name = $request->name;
        $dish->description = $request->description;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $dish->image = $imagePath;
        }
        
        $dish->user_id = $user->id;
        $dish->save();
        Mail::to($user->email)->send(new DishMail($user));

        return redirect()->route('listDishes')->with('succes', 'Inscription réussie ! + Mail Send');
    }

    public function deleteDish($id)
    {
        $dish = Dish::findOrFail($id);

        $dish->comments()->delete();
        $dish->likedBy()->delete();

        $dish->delete();

        dd("caca"); 
        return redirect()->route('listDishes')->with('success', 'Plat supprimé avec ses commentaires et likes.');
    }


    public function listUserDish()
    {
        $userConnected = Auth::user();
        $id = $userConnected->id;
        $plats = Dish::select('name', 'description', 'image', 'id')->where('user_id', $id)->paginate(9);

        return view('list_dishes_user', compact('plats'));
    }

    public function detailDish($id)
    {
        $plat = Dish::findOrFail($id);

        $comments = $plat->comments()->get();

        return view('Detail_Dish', compact('plat', 'comments'));
    }

    public function putComment(Request $request, $id)
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        $user = Auth::user();
        $dish = Dish::findOrFail($id);

        $comment = new Comment;
        $comment->text = $request->text;
        $comment->user_id = $user->id;
        $comment->dish_id = $dish->id;
        $comment->save();

        return back()->with('succes', 'commentaire bien envoyé !');
    }

    public function deleteComment($id){
        $comment = Comment::where('id', $id); 
        $comment->delete(); 
        return back(); 
    }

    public function dashboard()
    { 
        $user = Auth::user(); 
        $NbDishes = Dish::count();
        $NbClient = User::count();
        $userCO = Auth::user();
        
        if($userCO != null){
            $user = User::find($userCO->id);
        }else{
            return back()->withErrors('error', 'you need to be conected to got the acces');
        }
        
        $nbMyDishes = Dish::where('user_id', $user->id)->count(); 

        $nbDishesIlike = $user->likes()->count(); 

        $dishOfMyUser = Dish::where('user_id', $user->id)->get(); 
        $nbLikeOnMyDishes = 0;
        
        foreach($dishOfMyUser as $myDish){
           $nbLikeOnMyDishes += $myDish->likedBy()->count();
        }
     
        $topDish = Dish::withCount('likedBy')
            ->orderByDesc('liked_by_count')
            ->first();

        return view(('dashboard'), compact('NbDishes', 'NbClient', "nbMyDishes", "nbDishesIlike","nbLikeOnMyDishes","topDish"));
    }
}
