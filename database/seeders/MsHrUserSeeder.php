<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MsHrUser;
use Illuminate\Support\Facades\Hash;

class MsHrUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'username' => 'admin',
                'email' => 'admin@hrm.com',
                'password' => Hash::make('password123'),
                'role' => 'Admin',
                'is_active' => 1,
            ],
            [
                'username' => 'hr_manager',
                'email' => 'hr.manager@hrm.com',
                'password' => Hash::make('password123'),
                'role' => 'HR Manager',
                'is_active' => 1,
            ],
            [
                'username' => 'hr_staff',
                'email' => 'hr.staff@hrm.com',
                'password' => Hash::make('password123'),
                'role' => 'HR Staff',
                'is_active' => 1,
            ],
            [
                'username' => 'staff_test',
                'email' => 'staff@hrm.com',
                'password' => Hash::make('password123'),
                'role' => 'Staff',
                'is_active' => 0, // Untuk test user non-aktif
            ],
        ];

        foreach ($users as $userData) {
            MsHrUser::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}