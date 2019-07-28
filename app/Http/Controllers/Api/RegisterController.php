<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function register( Request $request )
    {
        $this->validateRequest( $request );

        $data = $request->all();

        if ( $request->password !== null || $request->password !== '' ) $data['password'] = bcrypt( $request->password );

        try {
            $user = User::create( $data );

            return response()->json( [ 'status' => 'success', 'token' => $user->createToken( 'ds-token' )->accessToken ], 201 );
        } catch ( \Exception $e ) {
            Log::debug( $e->getMessage() );

            return response()->json( [ 'status' => 'failure', 'token' => null ], 500 );
        }
    }

    /**
     * @param Request $request
     *
     * @return array|void
     */
    protected function validateRequest( Request $request ): void
    {
        $request->validate( [ 'name' => 'required|string|max:255', 'email' => 'unique:users' ] ); // email validation removed for facebook validation
    }
}
