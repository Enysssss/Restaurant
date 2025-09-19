<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DishUser extends Model
{
    use HasFactory;

    protected $table = 'dish_user';

    public $incrementing = false;

    public $timestamps = false;

    // cast ?
    protected $casts = [
        'user_id' => 'int',
        'dish_id' => 'int',
    ];

    protected $fillable = [
        'user_id',
        'dish_id',
    ];
}
