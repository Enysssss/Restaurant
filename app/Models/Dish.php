<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;

class Dish extends Model
{
    use HasFactory;
    use Encryptable;

    protected $table = 'dishes';

    protected $encryptable  = ['description'];

    protected $fillable = [
        'name',
        'description',
        'image',
        'user_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likedBy()
    {
        return $this->hasMany(DishUser::class,'dish_id');
    }

}
