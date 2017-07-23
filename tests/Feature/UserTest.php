<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions, WithoutMiddleware;

    public function testListingUsers()
    {
        $this->get('api/v1/users')->assertJsonStructure([
           [
               'id',
               'name',
           ]
        ]);
    }

    public function testCreateANewUser()
    {
        $this->post('api/v1/users', ['name' => 'Foo Bar'])->assertJson([
            'name' => 'Foo Bar',
        ]);
    }

    public function testDeletingAUser()
    {
        $user = factory(User::class)->create();
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $user->name,
        ]);

        $this->delete("api/v1/users/{$user->id}")->assertStatus(200);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
