<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2a$12$e6mxX9DDcN4376UaIxxbpOejfFmut5KnhTVNsKvR7ek6vuAsJLXsi', // password
            'role_id' => '1',
            'status' => '1',
        ])->assignRole('Admin');


        User::create([
            'name' => 'SuperAdmin',
            'email' => 'superAdmin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2a$12$e6mxX9DDcN4376UaIxxbpOejfFmut5KnhTVNsKvR7ek6vuAsJLXsi', // password
            'role_id' => '3',
            'status' => '1',
        ])->assignRole('SuperAdmin');

        User::create([
            'name' => 'Taxista1',
            'email' => 'Taxista1@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2a$12$e6mxX9DDcN4376UaIxxbpOejfFmut5KnhTVNsKvR7ek6vuAsJLXsi', // password
            'role_id' => '2',
            'status' => '1',
        ])->assignRole('Utilizador');
    }
}
