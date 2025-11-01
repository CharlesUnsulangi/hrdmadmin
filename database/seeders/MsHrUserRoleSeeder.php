<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MsHrUserRole;

class MsHrUserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'ms_hr_user_role_id' => 1,
                'ms_hr__user_role_name' => 'Super Admin',
                'created_at' => now(),
                'update_at' => now(),
            ],
            [
                'ms_hr_user_role_id' => 2,
                'ms_hr__user_role_name' => 'Admin',
                'created_at' => now(),
                'update_at' => now(),
            ],
            [
                'ms_hr_user_role_id' => 3,
                'ms_hr__user_role_name' => 'HR Manager',
                'created_at' => now(),
                'update_at' => now(),
            ],
            [
                'ms_hr_user_role_id' => 4,
                'ms_hr__user_role_name' => 'HR Staff',
                'created_at' => now(),
                'update_at' => now(),
            ],
            [
                'ms_hr_user_role_id' => 5,
                'ms_hr__user_role_name' => 'Manager',
                'created_at' => now(),
                'update_at' => now(),
            ],
            [
                'ms_hr_user_role_id' => 6,
                'ms_hr__user_role_name' => 'Staff',
                'created_at' => now(),
                'update_at' => now(),
            ],
            [
                'ms_hr_user_role_id' => 7,
                'ms_hr__user_role_name' => 'Viewer',
                'created_at' => now(),
                'update_at' => now(),
            ],
        ];

        foreach ($roles as $role) {
            MsHrUserRole::updateOrCreate(
                ['ms_hr_user_role_id' => $role['ms_hr_user_role_id']],
                $role
            );
        }
    }
}