<?php


namespace App\Http\Controllers\Auth;

use App\Model\User;
use JWTAuth;
use App\Http\Requests\ClientRegistrationFormRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AuthController

{
    /**
     * @param ClientRegistrationFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(ClientRegistrationFormRequest $request)
    {
        $user = UserRepository::create($request);
        return response()->json($user, 201);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $token = null;
        if (!$token = JWTAuth::attempt($input)) {
            return response()->json(
                [
                    'success' => false,
                    'message' => __('messages.INVALID_EMAIL_OR_PASSWORD') ,
                ],
                401
            );
        }
        return response()->json(
            [
                'role' =>auth()->user()->role,
                'success' => true,
                'token' => $token,
                'user'=>auth()->user()            ]
        );
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        JWTAuth::parseToken()->invalidate();
        return response()->json(['status' => true, 'message' =>__('messages.LOGOUT_SUCCESS_MESSAGE')]);
    }
}


