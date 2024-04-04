<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      
        $user= User::create([
            "name"=>"zohaib",
            "email"=>"admin@admin.com",
            "user_type"=>"admin",
            "password"=> Hash::make("12345678")
        ]);
    }
}
