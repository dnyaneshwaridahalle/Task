<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulePermissionSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('role_module_permission')->truncate();
        DB::table('modules')->truncate();
        DB::table('permissions')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Modules
        DB::table('modules')->insert([
            ['name' => 'Users', 'slug' => 'users'],
            ['name' => 'Search', 'slug' => 'search'],
            ['name' => 'Content', 'slug' => 'content'],
        ]);

        // Permissions
        DB::table('permissions')->insert([
            ['name' => 'View', 'slug' => 'view'],
            ['name' => 'Delete', 'slug' => 'delete'],
        ]);

        $adminRoleId = 1;
        $moderatorRoleId = 2;

        $modules = DB::table('modules')->pluck('id');
        $permissions = DB::table('permissions')->pluck('id');

        // Admin: full access
        foreach ($modules as $moduleId) {
            foreach ($permissions as $permissionId) {
                DB::table('role_module_permission')->insert([
                    'role_id' => $adminRoleId,
                    'module_id' => $moduleId,
                    'permission_id' => $permissionId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Moderator: only Users & Content modules, View & Delete
        $moderatorModules = DB::table('modules')->whereIn('slug', ['content'])->get();
        $moderatorPermissions = DB::table('permissions')->pluck('id'); // Both View & Delete

        foreach ($moderatorModules as $module) {
            foreach ($moderatorPermissions as $permId) {
                DB::table('role_module_permission')->insert([
                    'role_id' => $moderatorRoleId,
                    'module_id' => $module->id,
                    'permission_id' => $permId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
