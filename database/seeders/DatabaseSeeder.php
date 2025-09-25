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
        $users = User::factory()->count(2)->create();

        $dishes = Dish::factory()->count(3)->make()->each(function ($dish) use ($users) {
            $dish->user_id = $users->random()->id; 
            $dish->save();
        });

        Comment::factory()->count(5)->make()->each(function ($comment) use ($users, $dishes) {
            $comment->user_id = $users->random()->id;
            $comment->dish_id = $dishes->random()->id;
            $comment->save();
        });

        // foreach ($users as $user) {
        //     $user->likedDishes()->attach(
        //         $dishes->random(rand(1,2))->pluck('id')->toArray()
        //     );
        // }
        DishUser::create(['user_id' => 1, 'dish_id' => 1]);


        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);
    }
}
