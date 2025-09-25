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
        $Dish_Liked = $user->likedDishes()->pluck('dishes.id')->toArray();
        
        $nbLikes = [];
        $platsLiked = []; 
        foreach ($plats as $plat) {
            $platsLiked[$plat->id] = in_array($plat->id, $Dish_Liked);
            $nbLikes[$plat->id] = $plat->likedByUsers->count(); 
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

    public function destroy($id)
    {
        $dish = Dish::where('id', $id);
        $dish->delete();

        return back();
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
        
        $NB_MY_DISHES = $user->dishes()->count();

//        $NB_MY_LIKES = $user->likedDishes()->count();

        $plats = Dish::where('user_id', $user->id)->with('likedByUsers')->get();

        $plats2 = Dish::select('name', 'description', 'image', 'id')->paginate(9);

        $allMylLikes = 0;
        foreach ($plats2 as $plat) {
            $allMylLikes += $plat->likedByUsers->count();
            $nbLikes[$plat->id] = $plat->likedByUsers->count(); 
        }
        
        $platIdMax = array_search(max($nbLikes), $nbLikes);

       $data = max($nbLikes); 
        $DishMoreLiked = Dish::find($platIdMax);

        return view(('dashboard'), compact('NbDishes', 'NbClient', "NB_MY_DISHES", 'allMylLikes', 'DishMoreLiked','platIdMax','data'));
    }
}
