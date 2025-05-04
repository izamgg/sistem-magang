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
        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => User::ROLE_USER,
            'photo' => User::PHOTO_DEFAULT,
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => User::ROLE_ADMIN,
            'photo' => User::PHOTO_DEFAULT,
        ]);


        $dosen = User::create([
            'name' => 'Dosen',
            'email' => 'dosen@gmail.com',
            'password' => Hash::make('password'),
            'role' => User::ROLE_DOSEN,
            'photo' => User::PHOTO_DEFAULT,
        ]);

        $dosen = User::create([
            'name' => 'Dosen Penguji',
            'email' => 'dosenpenguji@gmail.com',
            'password' => Hash::make('password'),
            'role' => User::ROLE_DOSEN_PENGUJI,
            'photo' => User::PHOTO_DEFAULT,
        ]);
    }
}
