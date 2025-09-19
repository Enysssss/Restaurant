<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $table = 'dishes';

    protected $fillable = [
        'name',
        'description',
        'image',
        'user_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function FavedByUsers()
    {
        return $this->belongsToMany(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
