<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            [ 'email' => 'admin@hrd.local' ],
            [
                'name' => 'Admin HRD',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
                'role' => 'sa',
            ]
        );
    }
}
