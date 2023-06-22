<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Database\Console\Seeds\withoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => str::random(10),
                'is_admin' => true,
                // 'created_at' => now(),
                // 'updated_at' => now(),
            ],
            [
                'name' => 'gudang',
                'email' => 'gudang@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'is_admin' => false,
                // 'created_at' => now(),
                // 'updated_at' => now(),
            ],
        ];
        User::insert($user);
    }
}
