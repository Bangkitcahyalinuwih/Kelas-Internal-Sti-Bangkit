<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'admin',
                    'email' => 'admin@gmail.com',
                    'password' => Hash::make('admin'),
                    'role' => 'admin',
                    'created_at' => now(),
                ],
                [
                    'name' => 'operator',
                    'email' => 'operator@gmail.com',
                    'password' => Hash::make('operator'),
                    'role' => 'operator',
                    'created_at' => now(),
                ]
            ]
        );
    }
}
