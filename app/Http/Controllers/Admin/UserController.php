<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class UserController extends Controller
{
    public function index()
    {
        return view('layouts.admin.users.index');
    }
    public function fetchUser()
    {
        try {
            $user = User::with(['roles'])->get();
            $message = count($user) > 0? 'User fetched successfully' : 'No data';
            return FormatResponseJson::success($user, $message);
        } catch (\Throwable $th) {
            return FormatResponseJson::errpr(null, $th->getMessage(), 500);
        }
    }
    public function fetchRole()
    {
        try {
            $role = Role::all();
            $message = count($role) > 0? 'Role fetched successfully' : 'No data';
            return FormatResponseJson::success($role, $message);
        } catch (\Throwable $th) {
            return FormatResponseJson::errpr(null, $th->getMessage(), 500);
        }
    }
    public function detailUser($id)
    {
        try {
            $user = User::with(['roles'])->findOrFail($id);
            return FormatResponseJson::success($user, 'User detail fetched successfully');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
    // NEW: Get role detail with permissions
    public function detailRole($id)
    {
        try {
            $role = Role::with(['permissions'])->findOrFail($id);
            $allPermissions = Permission::all();

            $data = [
                'role' => $role,
                'all_permissions' => $allPermissions,
                'role_permissions' => $role->permissions->pluck('id')->toArray()
            ];

            return FormatResponseJson::success($data, 'Role detail fetched successfully');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
    public function updateRolePermissions(Request $request, $id)
    {
        try {
            // dd($request->all());
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'permissions' => 'nullable|array',
                'permissions.*' => 'exists:permissions,name'
            ]);

            if ($validator->fails()) {
                return FormatResponseJson::error(null, $validator->errors(), 422);
            }

            $role = Role::findOrFail($id);

            // Sync permissions (akan menghapus yang lama dan menambahkan yang baru)
            $permissions = $request->permissions ?? [];
            $role->syncPermissions($permissions);

            DB::commit();
            return FormatResponseJson::success($role, 'Role permissions updated successfully');

        } catch (\Throwable $th) {
            DB::rollBack();
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
    public function storeUser(Request $request)
    {
        try {
            DB::beginTransaction();

            $rules = [
                'user_name' => 'required|string|max:255',
                'user_email' => 'required|email|unique:users,email,' . ($request->id ?? 'NULL') . ',id',
                'user_role' => 'required|exists:roles,id',
            ];

            // Password required only on create
            if (!$request->id) {
                $rules['user_password'] = 'required|string|min:8|confirmed';
                $rules['user_password_confirmation'] = 'required';
            } else {
                $rules['user_password'] = 'nullable|string|min:8|confirmed';
            }

            $validator = Validator::make($request->all(), $rules, [
                'user_name.required' => 'Name is required',
                'user_email.required' => 'Email is required',
                'user_email.email' => 'Email must be valid',
                'user_email.unique' => 'Email already exists',
                'user_role.required' => 'Role is required',
                'user_role.exists' => 'Selected role is invalid',
                'user_password.required' => 'Password is required',
                'user_password.min' => 'Password must be at least 8 characters',
                'user_password.confirmed' => 'Password confirmation does not match',
            ]);

            if ($validator->fails()) {
                return FormatResponseJson::error(null, $validator->errors(), 422);
            }

            // Get or create user
            if ($request->id) {
                $user = User::findOrFail($request->id);
                $message = 'User updated successfully';
            } else {
                $user = new User();
                $message = 'User created successfully';
            }

            $user->name = $request->user_name;
            $user->email = $request->user_email;

            // Update password only if provided
            if ($request->user_password) {
                $user->password = Hash::make($request->user_password);
            }

            $user->save();

            // Sync role (remove all existing roles and assign new one)
            $user->syncRoles([$request->user_role]);

            DB::commit();
            return FormatResponseJson::success($user, $message);

        } catch (\Throwable $th) {
            DB::rollBack();
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }

    public function deleteUser($id)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);

            // Don't allow deleting own account
            if ($user->id == auth()->id()) {
                return FormatResponseJson::error(null, 'You cannot delete your own account', 403);
            }

            // Remove all roles
            $user->syncRoles([]);

            // Delete user
            $user->delete();

            DB::commit();
            return FormatResponseJson::success(null, 'User deleted successfully');

        } catch (\Throwable $th) {
            DB::rollBack();
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
}
