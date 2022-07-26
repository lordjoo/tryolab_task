<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private ApiResponse $response;

    public function __construct(ApiResponse $response)
    {
        $this->response = $response;
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ]);

        if (! $token = auth('api')->attempt($credentials)) {
            return $this->response->error("Unauthorized", 401)->return();
        }

        return $this->response->success("LOGG_IN_SUCCESS",[
            'token' => $token,
            'user' => auth()->user()
        ])->return();
    }
}
