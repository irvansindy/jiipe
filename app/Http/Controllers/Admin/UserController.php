<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class UserController extends Controller
{
    public function index()
    {
        return view('layouts.admin.users.index');
    }
    public function fetch()
    {
        try {
            $user = User::with(['roles'])->get();
            $message = count($user) > 0? 'User fetched successfully' : 'No data';
            return FormatResponseJson::success($user, $message);
        } catch (\Throwable $th) {
            return FormatResponseJson::errpr(null, $th->getMessage(), 500);
        }
    }
}
