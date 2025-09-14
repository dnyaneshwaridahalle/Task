<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RolesAndUsersSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'admin', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'moderator', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'user', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(['name' => $role['name']], $role);
        }

        $adminRoleId = DB::table('roles')->where('name', 'admin')->value('id');
        $moderatorRoleId = DB::table('roles')->where('name', 'moderator')->value('id');
        $userRoleId = DB::table('roles')->where('name', 'user')->value('id');

        DB::table('users')->updateOrInsert(
            ['email' => 'admin@gmail.com'],
            [
                'username' => 'admin',
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('Pass@123'),
                'location' => 'Headquarters',
                'role_id' => $adminRoleId,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('users')->updateOrInsert(
            ['email' => 'moderator@gmail.com'],
            [
                'username' => 'moderator',
                'name' => 'Moderator User',
                'email' => 'moderator@gmail.com',
                'password' => Hash::make('Pass@123'),
                'location' => 'Branch Office',
                'role_id' => $moderatorRoleId,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
