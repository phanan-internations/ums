<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\Membership;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MembershipTest extends TestCase
{
    use DatabaseTransactions, WithoutMiddleware;

    public function testAddingAUserIntoAGroup()
    {
        $group = factory(Group::class)->create();
        $user = factory(User::class)->create();

        $this->post('api/v1/memberships', [
            'group_id' => $group->id,
            'user_id' => $user->id,
        ])->assertStatus(200);

        $this->assertDatabaseHas('memberships', [
            'group_id' => $group->id,
            'user_id' => $user->id,
        ]);
    }

    public function testRemovingAUserFromAGroup()
    {
        /** @var Membership $membership */
        $membership = factory(Membership::class)->create();
        $this->assertDatabaseHas('memberships', [
            'user_id' => $membership->user->id,
            'group_id' => $membership->group->id,
        ]);

        $this->delete("api/v1/memberships/{$membership->id}", [])->assertStatus(200);

        $this->assertDatabaseMissing('memberships', ['id' => $membership->id]);
    }
}
