<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin FreshSoy',
                'email' => 'admin@freshsoy.test',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'phone_number' => '081234567890',
                'address' => 'FreshSoy HQ',
                'is_active' => true,
            ],
            [
                'name' => 'User Demo',
                'email' => 'user@freshsoy.test',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'phone_number' => '089876543210',
                'address' => 'Jl. mangga No. 1',
                'is_active' => true,
            ],
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}
