<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Strator',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        $user->assignRole('Admin');
    }
}
