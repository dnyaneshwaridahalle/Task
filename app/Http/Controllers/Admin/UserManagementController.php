<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;


class UserManagementController extends Controller
{
    // Show search form
    public function index()
    {
        $users = User::with('role')
            ->whereNotIn('role_id', [1, 2])
            ->orderBy('id', 'desc')
            ->paginate(8);

        return view('admin.users.search', compact('users'));
    }


    public function search(Request $request)
    {
        $search = $request->input('query');

        $users = User::with('role')
            ->whereNotIn('role_id', [1, 2])
            ->when($search, function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.users.search', compact('users', 'search'));
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (in_array($user->role_id, [1, 2])) {
            return redirect()->back()->with('error', 'You cannot delete Admin or Moderator accounts.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }
    public function manage(Request $request)
    {
        $roles = Role::whereIn('id', [2, 3])->get();

        $selectedRole = $request->role_id;

        $modules = Module::whereNot('id', 1)->get();

        $permissions = Permission::all();

        $roleModulePermissions = [];
        if ($selectedRole) {
            $rows = DB::table('role_module_permission')->where('role_id', $selectedRole)->get();
            foreach ($rows as $row) {
                $roleModulePermissions[$row->module_id][] = $row->permission_id;
            }
        }

        return view('admin.users.manage', compact(
            'roles',
            'modules',
            'permissions',
            'selectedRole',
            'roleModulePermissions'
        ));
    }


    public function updatePermissions(Request $request)
    {
        $roleId = $request->role_id;
        $permissions = $request->permissions ?? [];

        // Delete old permissions
        DB::table('role_module_permission')->where('role_id', $roleId)->delete();

        // Insert new permissions
        foreach ($permissions as $moduleId => $permIds) {
            foreach ($permIds as $permId) {
                DB::table('role_module_permission')->insert([
                    'role_id' => $roleId,
                    'module_id' => $moduleId,
                    'permission_id' => $permId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'Permissions updated successfully!');
    }

    public function contentModeration()
    {
        // Example data, you can replace with actual content to moderate
        $contents = [
            ['id' => 1, 'title' => 'User Post 1', 'status' => 'pending'],
            ['id' => 2, 'title' => 'User Post 2', 'status' => 'approved'],
            ['id' => 3, 'title' => 'User Post 3', 'status' => 'rejected'],
        ];

        return view('admin.users.content_moderation', compact('contents'));
    }
}
