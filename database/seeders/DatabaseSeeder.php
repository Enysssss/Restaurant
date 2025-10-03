<?php

namespace Database\Seeders;




use App\Models\DishUser;
use Dom\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            CommentSeeder::class,
            DishSeeder::class,
            DishUserSeeder::class,
            UserSeeder::class
        ]);
    }
}
