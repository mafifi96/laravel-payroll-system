<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
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
        //Admin Seeder for authentecation

        User::create([
            'name' => 'Mohamed Afifi',
            'email' => 'mafifi350@gmail.com',
            'password' => Hash::make("admin"),
        ]);
    }
}
