<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test123@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('123456789')
        ]);

        return $user;
    }
}
