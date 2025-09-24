<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Logib_test extends TestCase
{
         use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function Test_unit_1()
    {
        $response = $this->post('/login', [
            'username' => 'Test_User',
            'password' => 'Test_PSWD',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['username' => 'User non trouvé']);
        $this->assertTrue(session()->hasOldInput('username'));
        $this->assertEquals('nonexistent_user', session()->getOldInput('username'));
    }
}


// // <?php
// <?php

// namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Tests\TestCase; // 

// class LoginTest extends TestCase
// {
//     use RefreshDatabase;
// }

// Dans mon projet je souhaiterai implementer une api dactualiter svp 