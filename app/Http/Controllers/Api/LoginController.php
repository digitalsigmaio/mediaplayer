<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:api')->except('logout');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login( Request $request ): \Illuminate\Http\JsonResponse
    {
        $this->validateRequest( $request );

        return $this->attemptLogin( $request );
    }

    /**
     * @param Request $request
     *
     * @return array|void
     */
    protected function validateRequest( Request $request ): void
    {
        $request->validate( [ 'email' => 'required', 'password' => 'required' ] );
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function attemptLogin( Request $request ): \Illuminate\Http\JsonResponse
    {
        if ( Auth::attempt( [ 'email' => $request->email, 'password' => $request->password ] ) ) {
            $user = Auth::user();
            return response()->json( [ 'status' => 'success', 'token' => $user->createToken( 'ds-token' )->accessToken ], 200 );
        } else {
            return response()->json( [ 'status' => 'Your email or password is not correct', 'token' => null ], 401 );
        }
    }

    /**
     * @return mixed
     */
    protected function guard()
    {
        return Auth::guard('api');
    }
}
