<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Dish;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Mail\DishMail;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;


class DishControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_displays_create_dish_form()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('formDish'));
        $response->assertStatus(200);
        $response->assertViewIs('create_dish');
    }

    #[Test]
    public function it_creates_a_dish_successfully()
    {
        Mail::fake();

        $user = User::factory()->create();
        $this->actingAs($user);

        $dishData = [
            'name' => 'Test Dish',
            'description' => 'Test Description',
            'image' => UploadedFile::fake()->image('dish.jpg'),
        ];

        $response = $this->post(route('createDish'), $dishData);

        $response->assertRedirect(route('listDishes'));

        $this->assertDatabaseHas('dishes', [
            'name' => 'Test Dish',
            'description' => 'Test Description',
            'user_id' => $user->id,
        ]);
    }

    #[Test]
    public function it_lists_all_dishes()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Dish::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->get(route('listDishes'));
        $response->assertStatus(200);
        $response->assertViewHas('plats');
    }

    #[Test]
    public function it_lists_user_dishes()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Dish::factory()->count(2)->create(['user_id' => $user->id]);

        $response = $this->get(route('listUserDish'));
        $response->assertStatus(200);
        $response->assertViewHas('plats');
    }

    #[Test]
    public function it_displays_dish_detail_with_comments()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $dish = Dish::factory()->create(['user_id' => $user->id]);
        Comment::factory()->create(['dish_id' => $dish->id, 'user_id' => $user->id]);

        $response = $this->get(route('detailDish', $dish->id));
        $response->assertStatus(200);
        $response->assertViewHasAll(['plat', 'comments']);
    }

    #[Test]
    public function it_can_put_a_comment_on_a_dish()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $dish = Dish::factory()->create(['user_id' => $user->id]);

        $commentData = [
            'text' => 'Test Comment',
        ];

        $response = $this->post(route('putComment', $dish->id), $commentData);

        $response->assertRedirect();
        $this->assertDatabaseHas('comments', [
            'text' => 'Test Comment',
            'user_id' => $user->id,
            'dish_id' => $dish->id,
        ]);
    }

    #[Test]
    public function it_can_delete_a_comment()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $dish = Dish::factory()->create(['user_id' => $user->id]);
        $comment = Comment::factory()->create(['dish_id' => $dish->id, 'user_id' => $user->id]);

        $response = $this->delete(route('deleteComment', $comment->id));
        $response->assertRedirect();

        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
    }

    #[Test]
    public function it_can_delete_a_dish_with_comments_and_likes()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $dish = Dish::factory()->create(['user_id' => $user->id]);
        Comment::factory()->create(['dish_id' => $dish->id, 'user_id' => $user->id]);

        $response = $this->delete(route('deleteDish', $dish->id));
        $response->assertStatus(200); // ou assertRedirect() si ton controller redirige

        $this->assertDatabaseMissing('dishes', ['id' => $dish->id]);
        $this->assertDatabaseMissing('comments', ['dish_id' => $dish->id]);
    }

    #[Test]
    public function it_displays_dashboard_with_counts()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Plats de l'utilisateur connecté
        Dish::factory()->count(3)->create(['user_id' => $user->id]);

        // Plats d'autres utilisateurs
        Dish::factory()->count(2)->create(['user_id' => User::factory()]);

        $response = $this->get(route('dashboard'));
        $response->assertStatus(200);
        $response->assertViewHasAll([
            'NbDishes',
            'NbClient',
            'nbMyDishes',
            'nbDishesIlike',
            'nbLikeOnMyDishes',
            'topDish',
        ]);
    }
}
