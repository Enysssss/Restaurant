<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Dish;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostModelFunctionalityTest extends TestCase
{
    use RefreshDatabase; 

    public function test_attributes_are_set_correctly_user()
    {
        $user = new User([
            'name' => 'Nom_User',
            'password' => 'MDP', 
        ]);

        $this->assertEquals('Nom_User', $user->name);
        $this->assertTrue(Hash::check('MDP', $user->password)); 
    }


   public function test_attributes_are_set_correctly_dish()
   {
       $dish = new Dish([
           'name' => 'Nom_Plat',
           'description' => 'Description du plat',
           'image' => 'test.jpg',
       ]);

       $this->assertEquals('Nom_Plat', $dish->name);
       $this->assertEquals('Description du plat', $dish->description);
       $this->assertEquals('test.jpg', $dish->image);
   }


}
