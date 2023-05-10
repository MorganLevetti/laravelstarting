<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // User::create([
        //     'name' => 'admin',
        //     'username' => 'test',
        //     'email' => 'test@example.com',
        //     'password' => Hash::make('password'),
        //     'remember_token' => Str::random(10),
        // ]);
    }
}
