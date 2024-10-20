<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin2.com',
            'password' => Hash::make('password')
        ]);

        $creat = User::create([
            'name' => 'create',
            'email' => 'create@create2.com',
            'password' => Hash::make('password')
        ]);

        $user = User::create([
            'name' => 'user',
            'email' => 'user@user2.com',
            'password' => Hash::make('password')
        ]);

    
        $admin->roles()->attach(['1','2']);
        $creat->roles()->attach(['2']);
        $user->roles()->attach(['3']);
    }
}
