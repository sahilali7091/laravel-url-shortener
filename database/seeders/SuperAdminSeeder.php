<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('admin@123');
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => $password,
            'role' => 'superadmin',
        ]);
    }
}
