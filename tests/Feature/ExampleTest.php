<?php

namespace Tests\Feature;

use App\Mail\DishMail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_store_a_dish_and_receive_an_email()
    {
        Mail::fake();
        // Storage::fake('public');

        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('create_dish'), [
            'name' => 'Pizza',
            'description' => 'Délicieuse pizza',
            'image' => 'https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=480&w=640',
        ]);

        $response->assertRedirect(route('list_dishes'));
        $response->assertSessionHas('succes', 'Inscription réussie ! + Mail Send');

        $this->assertDatabaseHas('dishes', [
            'name' => 'Pizza',
            'description' => 'Délicieuse pizza',
            'user_id' => $user->id,
        ]);

        // Mail::assertSent(DishMail::class, function ($mail) use ($user) {
        //     return $mail->hasTo($user->email);
        // });
    }
}
