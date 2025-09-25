<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use
class DishTest extends TestCase
{
    /**
     * A basic unit test example.
     */
     public function un_dish_peut_etre_cree()
    {
        $user = User::factory()->create();

        $dish = Dish::create([
            'name' => 'Pizza',
            'description' => 'Delicious cheese pizza',
            'image' => 'pizza.jpg',
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('dishes', [
            'name' => 'Pizza',
            'user_id' => $user->id,
        ]);

        $this->assertEquals('Pizza', $dish->name);
    }
}
