<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GroupTest extends TestCase
{
    use DatabaseTransactions, WithoutMiddleware;

    public function testListingGroups()
    {
        $this->get('api/v1/groups')->assertJsonStructure([
            [
                'name'
            ]
        ]);
    }

    public function testCreatingANewGroup()
    {
        $this->post('api/v1/groups', ['name' => 'Foo Bar'])->assertJson([
            'name' => 'Foo Bar',
        ]);
        $this->assertDatabaseHas('groups', ['name'=> 'Foo Bar']);
    }

    public function testDeletingNotEmptyGroups()
    {
        // Create a group and add several users into it
        /** @var Group $group */
        $group = factory(Group::class)->create();
        /** @var Collection $users */
        $users = factory(User::class, 3)->create();
        $group->users()->sync($users);

        // We shouldn't be able to delete the group.
        $this->delete("api/v1/groups/{$group->id}")->assertStatus(403);
        $this->assertDatabaseHas('groups', ['id' => $group->id]);
    }

    public function testDeletingEmptyGroups()
    {
        // Create a group (which is empty initially)
        /** @var Group $group */
        $group = factory(Group::class)->create();

        // We should be able to delete the group.
        $this->delete("api/v1/groups/{$group->id}")->assertStatus(200);
        $this->assertDatabaseMissing('groups', ['id' => $group->id]);
    }
}
