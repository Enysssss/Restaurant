<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Dish;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    use RefreshDatabase;

    // Home page
    #[\PHPUnit\Framework\Attributes\Test]
    public function home_page_is_accessible()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('home'));
        $response->assertStatus(200);
    }

    // User form page
    #[\PHPUnit\Framework\Attributes\Test]
    public function form_user_page_is_accessible()
    {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get(route('formUser'));
    $response->assertStatus(200);
    }

    // Create user
    #[\PHPUnit\Framework\Attributes\Test]
    public function create_user_route_works()
    {
        $response = $this->post(route('createUser'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    // Login form page
    #[\PHPUnit\Framework\Attributes\Test]
    public function login_form_page_is_accessible()
    {
        $response = $this->get(route('formLogin'));
        $response->assertStatus(200);
    }

    // Dish form page
    #[\PHPUnit\Framework\Attributes\Test]
    public function form_dish_page_is_accessible()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('formDish'));
        $response->assertStatus(200);
    }

    // List dishes page
    #[\PHPUnit\Framework\Attributes\Test]
    public function list_dishes_page_is_accessible()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('listDishes'));
        $response->assertStatus(200);
    }

    // List user dishes page
    #[\PHPUnit\Framework\Attributes\Test]
    public function list_user_dishes_page_is_accessible()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('listUserDish'));
        $response->assertStatus(200);
    }

    // Dashboard page
    #[\PHPUnit\Framework\Attributes\Test]
    public function dashboard_page_is_accessible()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Crée des plats si la vue en a besoin
        Dish::factory()->create(['user_id' => $user->id]);

        $response = $this->get(route('dashboard'));
        $response->assertStatus(200);
    }

    // Logout route
    #[\PHPUnit\Framework\Attributes\Test]
    public function logout_route_redirects_to_login()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('logout'));
        $response->assertRedirect(route('formLogin'));
    }

    // Fallback route
    #[\PHPUnit\Framework\Attributes\Test]
    public function fallback_route_returns_404_view()
    {
        $response = $this->get('/unknown-route');
        $response->assertStatus(200); // fallback renvoie une vue 404
        $response->assertViewIs('404');
    }

    // Like a dish
    #[\PHPUnit\Framework\Attributes\Test]
    public function can_like_a_dish()
    {
        $user = User::factory()->create();
        $dish = Dish::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);
        $response = $this->post(route('like', $dish->id));

        $response->assertStatus(302); // redirect après like
    }

    // Unlike a dish
    #[\PHPUnit\Framework\Attributes\Test]
    public function can_unlike_a_dish()
    {
        $user = User::factory()->create();
        $dish = Dish::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);
        $response = $this->delete(route('unlike', $dish->id));

        $response->assertStatus(302); // redirect après unlike
    }
}
