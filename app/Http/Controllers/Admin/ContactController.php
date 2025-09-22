<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactEmail;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index()
    {
        return view('layouts.admin.contact.index');
    }
    public function fetchContactEmail()
    {
        try {
            $email = ContactEmail::orderBy('id','desc')->get;
            $message = count($email) > 0 ? 'Success' :'No data';
            return FormatResponseJson::success($email, $message);
        } catch (\Throwable $th) {
            return FormatResponseJson::error($th->getMessage(), 500);
        }
    }
}
