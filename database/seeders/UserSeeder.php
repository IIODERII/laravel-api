<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Oder',
                'email' => 'o@o.com',
                'password' => '12345678',
            ]
        ];
        foreach ($users as $user) {
            $newUser = new User();
            $newUser->name = $user['name'];
            $newUser->email = $user['email'];
            $newUser->password = $user['password'];
            $newUser->save();
        }
    }
}
