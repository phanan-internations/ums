<?php

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::unguard();
        Group::create([
            'name' => 'Sample Group',
        ]);
        Group::reguard();
    }
}
