<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => bcrypt(12345678),
            'is_admin' => true,
            'status' => true
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'Operator',
            'email' => 'operator@example.com',
            'password' => bcrypt(12345678),
            'is_admin' => false,
            'status' => true
        ]);

        $user->assignRole('user');
    }
}
