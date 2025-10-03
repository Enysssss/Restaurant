<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Dish $dish)
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        $user = Auth::user();
        Comment::create([
            'text' => $request->text,
            'user_id' =>$user->id,
            'dish_id' =>$dish->id,
        ]);

        return back()->with('succes', 'commentaire bien envoyé !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
