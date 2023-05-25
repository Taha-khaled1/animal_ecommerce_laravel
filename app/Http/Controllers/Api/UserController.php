<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Services\CustomerService;
use http\Client\Curl\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function user(Request $request)
    {
        return Auth::user();
    }

    public function logout(Request $request)
    {
        Auth::user()->update(
            [
                'api_token' => null
            ]
        );
        return responseFunction('message','success', '200');

    }


}
