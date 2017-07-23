<?php

namespace Tests\Feature;

use App\Models\Administrator;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthenticationTest extends TestCase
{
    use DatabaseTransactions;

    public function testLogin()
    {
        $response = $this->post('api/v1/login', [
            'username' => 'admin',
            'password' => 'password',
        ]);

        $response->assertJsonStructure([
            'id',
            'name',
            'username',
            'api_token',
        ]);
    }

    public function testGetLoggedInAdmin()
    {
        $administrator = factory(Administrator::class)->create();

        $this->get('api/v1/me', ['Authorization' => "Bearer {$administrator->api_token}"])
            ->assertStatus(200)
            ->assertJson([
                'id' => $administrator->id,
                'name' => $administrator->name,
            ]);
    }

    public function testLogout()
    {
        // Firstly, un authenticated user is forbidden to use the route.
        $this->post('api/v1/logout', [])->assertStatus(403);

        // Now we set up our test administrator
        $administrator = factory(Administrator::class)->create();

        // When we post to the log out route
        $this->post('api/v1/logout', [], ['Authorization' => "Bearer {$administrator->api_token}"])
            ->assertStatus(200);

        // We see the token is cleared
        $administrator->refresh();
        $this->assertNull($administrator->api_token);
    }
}
