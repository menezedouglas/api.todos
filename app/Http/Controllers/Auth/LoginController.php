<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Repositories\Auth\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    protected $guard;

    public function __construct() {
        $this->guard = 'users-guard';
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {

        try {

            if(Auth::check())
                $user = Auth::user();

            return response()->json($user);

        } catch (\Exception $error) {

            return responseError($error, 'Ops...');

        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function store(LoginRequest $request): JsonResponse
    {

        try {

            $abort = function () {
                abort(401, 'E-mail ou senha incorretos');
            };

            $userRepository = new UserRepository();

            $user = $userRepository->getWhere([
                'email' => $request->email,
            ])->first();

            if(is_null($user)) $abort();

            $auth = Hash::check($request->password, $user->password);

            if(!$auth) $abort();

            $token = Auth::login($user, true);

            return $this->createNewToken($token, $user);

        } catch (\Exception $error) {

            return responseError($error, 'Ops...');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return JsonResponse
     */
    public function destroy(): JsonResponse
    {
        try {

            auth()->logout();

            return response()->json([]);

        } catch (\Exception $error) {

            return responseError($error, 'Ops...');

        }
    }

    protected function createNewToken(string $token, object $user): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth($this->guard)->factory()->getTTL() * 60,
            'user' => $user
        ]);
    }
}
