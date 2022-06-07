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
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'      => 'Raycon',
                'email'     => 'raycon@gmail.com',
                'profile'   => 'administrator',
                'password'  => Hash::make('123456789'),
                
            ],
            [
                'name'      => 'Maycon',
                'email'     => 'maycon@gmail.com',
                'profile'   => 'user',
                'password'  => Hash::make('123456789'),
                
            ]
        ];
        User::insert($users);
    }
}
