<?php

use App\Models\Administrator;
use Illuminate\Database\Seeder;

class AdministratorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Administrator::unguard();
        Administrator::create([
            'name' => 'Admin Instrator',
            'username' => 'admin',
            'password' => Hash::make('password'),
        ]);
        Administrator::reguard();
    }
}
