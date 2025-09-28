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
}
