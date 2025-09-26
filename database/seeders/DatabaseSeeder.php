<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\User;
use App\Models\Comment;
use App\Models\DishUser;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory()->count(10)->create();

        $dishes = Dish::factory()->count(30)->make()->each(function ($dish) use ($users) {
            $dish->user_id = $users->random()->id; 
            $dish->save();
        });

        Comment::factory()->count(20)->make()->each(function ($comment) use ($users, $dishes) {
            $comment->user_id = $users->random()->id;
            $comment->dish_id = $dishes->random()->id;
            $comment->save();
        });

        foreach ($users as $user) {
        foreach ($dishes->random(rand(1,10)) as $dish) {
            DishUser::firstOrCreate([
                'user_id' => $user->id,
                'dish_id' => $dish->id,
            ]);
        }
    }

        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);
    }
}
