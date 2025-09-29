<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Dish;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserMail;
use Spatie\Permission\Models\Role;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Empêcher l'envoi de mails réels
        Mail::fake();

        // Créer le rôle admin si non existant
        if (! Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }
    }

    #[Test]
    public function it_displays_register_page()
    {
        $response = $this->get(route('formUser'));
        $response->assertStatus(200);
    }

    #[Test]
    public function it_creates_a_user_successfully()
    {
        $response = $this->post(route('createUser'), [
            'username' => 'testuser',
            'password' => 'password',
        ]);

        $this->assertDatabaseHas('users', ['name' => 'testuser']);
        $response->assertRedirect(route('formLogin'));
    }

    #[Test]
    public function it_fails_creating_user_with_existing_username()
    {
        User::factory()->create(['name' => 'testuser']);

        $response = $this->post(route('createUser'), [
            'username' => 'testuser',
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors('username');
    }

    #[Test]
    public function it_logs_in_successfully()
    {
        $user = User::factory()->create([
            'name' => 'testuser',
            'password' => Hash::make('password'),
        ]);

        $response = $this->post(route('loginUser'), [
            'username' => 'testuser',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    #[Test]
    public function it_fails_login_with_wrong_password()
    {
        $user = User::factory()->create([
            'name' => 'testuser',
            'password' => Hash::make('password'),
        ]);

        $response = $this->post(route('loginUser'), [
            'username' => 'testuser',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    #[Test]
    public function it_can_like_and_unlike_a_dish()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $dish = Dish::factory()->create(['user_id' => $user->id]);

        // Like
        $this->post(route('like', $dish->id));
        $this->assertDatabaseHas('dish_user', [
            'user_id' => $user->id,
            'dish_id' => $dish->id,
        ]);

        // Unlike
        $this->delete(route('unlike', $dish->id));
        $this->assertDatabaseMissing('dish_user', [
            'user_id' => $user->id,
            'dish_id' => $dish->id,
        ]);
    }
    
    #[Test]
    public function it_can_edit_a_dish()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Création d'un plat initial
        $dish = Dish::factory()->create([
            'user_id' => $user->id,
            'name' => 'Original Dish',
            'description' => 'Original Description',
        ]);

        // Données mises à jour
        $updatedData = [
            'name' => 'Updated Dish',
            'description' => 'Updated Description',
        ];

        $response = $this->post(route('edit', $dish->id), $updatedData);
        $response->assertRedirect(); // ou assertStatus(302) si redirection

        // Récupérer le plat et vérifier les valeurs décryptées
        $dishFresh = Dish::find($dish->id);

        $this->assertEquals('Updated Dish', $dishFresh->name);
        $this->assertEquals('Updated Description', $dishFresh->description);
    }


    #[Test]
    public function it_can_delete_a_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->delete(route('deleteUser', $user->id));

        $response->assertRedirect();
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    #[Test]
    public function it_can_toggle_admin_role()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Deviens admin
        $this->delete(route('userBecomeAdmin', $user->id));
        $this->assertTrue($user->fresh()->hasRole('admin'));

        // Perd admin
        $this->delete(route('userBecomeAdmin', $user->id));
        $this->assertFalse($user->fresh()->hasRole('admin'));
    }
}
