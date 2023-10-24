<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LoginResource;
use App\Http\Resources\MeResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     * API: 2735
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginWithMobile()
    {
        $credentials = request(['mobile_number', 'password']);
        $user = Customer::where('mobile_number',$credentials['mobile_number'])->first();

        if( $user == null )
        return response()->json(['error' => ['message' => 'Sorry! You have not yet completed the registration process.'] ], 200);

        if( $user->status == 2 )
            return response()->json(['error' => ['message' => 'Your account has been suspended; please contact support.'] ], 200);

        $credentials = request(['mobile_number', 'password']);
        if (!$token = auth()->guard('customer-api')->attempt($credentials))
        // if (!$token = auth()->guard('customer-api')->login($user))
        {
            return response()->json(['error' => ['message' => 'Invalid password or mobile number combination.'] ], 200);
        }

        return new LoginResource( ['access_token' => $token, 'message' => "I've successfully logged in.", 'currentLoginUser' => auth()->guard('customer-api')->user()] );
    }

    /**
     * Get a JWT via given credentials.
     * API: 2734
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginWithEmail()
    {
        $credentials = request(['email', 'password']);
        $user = Customer::where('email',$credentials['email'])->first();

        if( $user ){
            if( $user->status == 2 )
                return response()->json([ 'error' => [ 'message' => 'Your account has been suspended; please contact support.'] ], 200);

            $credentials = request(['email', 'password']);
            // if (!$token = auth()->guard('customer-api')->login($user))
            if (!$token = auth()->guard('customer-api')->attempt($credentials))
            {
                return response()->json( [ 'error' => ['message' => 'Invalid email or password combination.'] ], 200);
            }

            return new LoginResource( ['access_token' => $token, 'message' => "Logged in successfully.", 'currentLoginUser' => auth()->guard('customer-api')->user()] );
        } else {
            return response()->json( [ 'error' => ['message' => 'Sorry! You have not completed the registration process.'] ], 200);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        $currentLoginUser =  auth()->guard('customer-api')->user();

        if ($request->has('device_id') ) {// && $request->device_id
            $currentLoginUser->device_id = $request->device_id;
            $currentLoginUser->save();
        }

        return new MeResource(['currentLoginUser' => $currentLoginUser]);
    }
    
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
		auth()->logout();
        Auth::guard('customer-api')->logout();
        Session::flush('auth_id');
        Session::flush('token');
        unsetCookie('auth_id', '');
        unsetCookie('token', '');
        return response()->json( ['message' => 'Log out successfully.' ], 200);
    }
}
