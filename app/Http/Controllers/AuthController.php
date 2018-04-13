<?php

namespace App\Http\Controllers;

use App\{
    User,
    Models\RoleMenu
};

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['username', 'password']);
        if (! $token = auth()->attempt($credentials)) {
            return $this->response->array(repJson(401, 'error Unauthorized'));
        }

        return repJson([
            'data'=> [
                'token' => $this->respondWithToken($token),
                'user' => Auth::user(),
                'menus' => getUserPermissionsAndMenus(Auth::user()),
            ]
        ]);
    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return repJson([
            'data'=>auth()->user()
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return repJson();
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return repJson([
            'data' =>[
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ]
        ]);
    }
}