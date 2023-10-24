<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\UserToken;
use JWTAuth;
use App\Models\InsterestedStudyArea;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class JWTAuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function getSocialCallback($account)
    {
        $socialUser = Socialite::with($account)->user();
        dd($socialUser);
        $user = User::where('provider_id', '=', $socialUser->id)->where('provider', '=', $account)->first();

        if ($user == null) {
            $newUser = new User();

            $newUser->name        = $socialUser->getName();
            $newUser->email       = $socialUser->getEmail() == '' ? '' : $socialUser->getEmail();
            $newUser->avatar      = $socialUser->getAvatar();
            $newUser->password    = '';
            $newUser->provider    = $account;
            $newUser->provider_id = $socialUser->getId();

            $newUser->save();

            $user = $newUser;
        }

        Auth::login($user);

        return redirect('/');
    }

    public function googleRegister(Request $request)
    {
        try {
            $user = User::where('email', $request->user['email'])->first();
            if ($user) {
                $user->first_name = ($user->first_name != '') ? $request->user['givenName'] : '';
                $user->last_name = ($user->last_name != '') ? $request->user['familyName'] : '';
                $user->email = ($user->email != '') ? $request->user['email'] : '';
            } else {
                $user = new User();
                $user->first_name = $request->user['givenName'];
                $user->last_name = $request->user['familyName'];
                $user->email = $request->user['email'];
                $user->google_id = $request->user['id'];
                $user->type = 'user';
            }
            $user->save();
            return response()->json(['success' => true, 'message' => Config::get('constants.GOOGLE_REGISTER'), 'user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['message' => Config::get('constants.SOMETHING_WENT_WRONG'), 'error_message' => $e]], 422);
        }
    }

    public function updateSocialLogin(Request $request)
    {
        try {
            $validator = validator::make($request->all(), [
                'provider' => 'required',
                'email' => 'required',
                'access_token' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $user = User::where('email', $request->email)->first();
            if ($request->provider = 'google') {
                $user->google_id = $request->access_token;
            } else if ($request->provider = 'facebook') {
                $user->facebook_id = $request->access_token;
            } else {
                $user->linkedin_id = $request->access_token;
            }
            $user->save();
            $token = auth('api')->login($user);
            $userToken = UserToken::where('user_id', $user->id)->first();
            if (!empty($userToken)) {
                $userToken->delete();
            }

            $userToken = new UserToken();
            $userToken->user_id = $user->id;
            $userToken->token = $token;
            $userToken->save();
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 6000,
                'data' => auth('api')->user(),
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['message' => Config::get('constants.SOMETHING_WENT_WRONG'), 'error_message' => $e]], 422);
        }
    }

    public function socialLogin(Request $request)
    {
        try {
            $validator = validator::make($request->all(), [
                'provider' => 'required',
                'email' => 'required',
                'access_token' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            if ($request->hasfile('image')) {
                $file = $request->file('image');
                $fileName = 'students/profile-image';
                $url = uploadGcsFile($file, $fileName);
            }

            if ($request->provider == 'google') {
                // $user = User::where('google_id', $request->auth)->first();
                $user = User::where('email', $request->email)->first();
                if ($user) {
                    $user->google_id = $request->access_token;
                } else {
                    $user = new User();
                    $user->first_name = $request->first_name;
                    $user->last_name = $request->last_name;
                    $user->email = $request->email;
                    $user->google_id = $request->access_token ?? '';
                    $user->graduation_status = $request->join_as;
                    $user->preferred_location = $request->preferred_location;
                    $user->gender = $request->gender;
                    $user->date_of_birth = $request->date_of_birth;
                    $user->sport_id = $request->primary_sport;
                    $user->country_id = $request->nationality;
                    $user->ethnicites_id = $request->ethnicity;
                    $user->course_preference = $request->course_preference;
                    $user->planned_entry_date = $request->entry_date;
                    $user->school_attended = $request->school_attended;
                    !isset($url) ?? $user->profile_picture = $url;
                    $user->type = 'user';
                    
                    Mail::send('email.joining_mail', ['data' => $user], function ($message) use ($user) {
                        $message->to($user['email'])
                            // ->from($data['from_email'], 'Sportsfolio')
                            ->subject("Welcome to Sportfolio");
                    });

                }
                $user->save();

                $sport_id =  $user->sport_id;
                $primary_position = NULL;
                $additional_position = NULL;
                $weight = NULL;
                $height = NULL;
                $achievement = NULL;
                $additional_info = NULL;
                $values = array('user_id' => $user->id, 'sport_id' => $sport_id, 'primary_position_id' => $primary_position, 'additional_position_id' => $additional_position, 'weight' => $weight, 'height' => $height, 'achievement' => $achievement, 'additional_info' => $additional_info);
                $insert = DB::table('user_sports')->insertGetId($values);
                DB::commit();

                $token = auth('api')->login($user);
                $userToken = UserToken::where('user_id', $user->id)->first();
                if (!empty($userToken)) {
                    $userToken->delete();
                }

                $userToken = new UserToken();
                $userToken->user_id = $user->id;
                $userToken->token = $token;
                $userToken->save();

                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'expires_in' => auth('api')->factory()->getTTL() * 6000,
                    'data' => auth('api')->user(),
                ]);
            }

            if ($request->provider == 'facebook') {
                $user = User::where('email', $request->email)->first();
                if ($user) {
                    $user->facebook_id = $request->access_token;
                } else {
                    $user = new User();
                    $user->first_name = $request->first_name;
                    $user->last_name = $request->last_name;
                    $user->email = $request->email;
                    $user->facebook_id = $request->access_token;
                    $user->graduation_status = $request->join_as;
                    $user->preferred_location = $request->preferred_location;
                    $user->gender = $request->gender;
                    $user->date_of_birth = $request->date_of_birth;
                    $user->sport_id = $request->primary_sport;
                    $user->country_id = $request->nationality;
                    $user->ethnicites_id = $request->ethnicity;
                    $user->course_preference = $request->course_preference;
                    $user->planned_entry_date = $request->entry_date;
                    $user->school_attended = $request->school_attended;
                    $user->profile_picture = $url;
                    $user->type = 'user';
                    
                    Mail::send('email.joining_mail', ['data' => $user], function ($message) use ($user) {
                        $message->to($user['email'])
                            // ->from($data['from_email'], 'Sportsfolio')
                            ->subject("Welcome to Sportfolio");
                    });
                }
                $user->save();
                $sport_id =  $user->sport_id;
                $primary_position = NULL;
                $additional_position = NULL;
                $weight = NULL;
                $height = NULL;
                $achievement = NULL;
                $additional_info = NULL;
                $values = array('user_id' => $user->id, 'sport_id' => $sport_id, 'primary_position_id' => $primary_position, 'additional_position_id' => $additional_position, 'weight' => $weight, 'height' => $height, 'achievement' => $achievement, 'additional_info' => $additional_info);
                $insert = DB::table('user_sports')->insertGetId($values);
                DB::commit();

                $token = auth('api')->login($user);
                $userToken = UserToken::where('user_id', $user->id)->first();
                if (!empty($userToken)) {
                    $userToken->delete();
                }

                $userToken = new UserToken();
                $userToken->user_id = $user->id;
                $userToken->token = $token;
                $userToken->save();
                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'expires_in' => auth('api')->factory()->getTTL() * 6000,
                    'data' => auth('api')->user(),
                ]);
            }

            if ($request->provider == 'linkedIn') {
                $validator = validator::make($request->all(), [
                    'provider' => 'required',
                    'email' => 'required',
                    'access_token' => 'required',
                ]);
                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }
                $user = User::where('email', $request['email'])->first();
                if ($user) {
                    $user->linkedin_id = $request->access_token;
                 } else {
                 
                    $user = new User();
                    $user->first_name = $request->first_name;
                    $user->last_name = $request->last_name;
                    $user->email = $request->email;
                    $user->linkedin_id = $request->access_token;
                    $user->graduation_status = $request->join_as;
                    $user->preferred_location = $request->preferred_location;
                    $user->gender = $request->gender;
                    $user->date_of_birth = $request->date_of_birth;
                    $user->sport_id = $request->primary_sport;
                    $user->country_id = $request->nationality;
                    $user->ethnicites_id = $request->ethnicity;
                    $user->course_preference = $request->course_preference;
                    $user->planned_entry_date = $request->entry_date;
                    $user->school_attended = $request->school_attended;
                    $user->profile_picture = $url;
                    $user->type = 'user';
                    
                    Mail::send('email.joining_mail', ['data' => $user], function ($message) use ($user) {
                        $message->to($user['email'])
                            // ->from($data['from_email'], 'Sportsfolio')
                            ->subject("Welcome to Sportfolio");
                    });
                }
                $user->save();

                $sport_id =  $user->sport_id;
                $primary_position = NULL;
                $additional_position = NULL;
                $weight = NULL;
                $height = NULL;
                $achievement = NULL;
                $additional_info = NULL;
                $values = array('user_id' => $user->id, 'sport_id' => $sport_id, 'primary_position_id' => $primary_position, 'additional_position_id' => $additional_position, 'weight' => $weight, 'height' => $height, 'achievement' => $achievement, 'additional_info' => $additional_info);
                $insert = DB::table('user_sports')->insertGetId($values);
                DB::commit();

                $token = auth('api')->login($user);
                $userToken = UserToken::where('user_id', $user->id)->first();
                if (!empty($userToken)) {
                    $userToken->delete();
                }

                $userToken = new UserToken();
                $userToken->user_id = $user->id;
                $userToken->token = $token;
                $userToken->save();
                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'expires_in' => auth('api')->factory()->getTTL() * 6000,
                    'data' => auth('api')->user(),
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['message' => Config::get('constants.SOMETHING_WENT_WRONG'), 'error_message' => $e]], 422);
        }
    }


    public function getLinkidInData(Request $request)
    {
        $validator = validator::make($request->all(), ['code' => 'required']);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if ($request->isMobile == 1) {
            $accessTokenData = $request->code;
        } else {
            $accessTokenData = getAccessToken($request->code);
            if (!$accessTokenData) {
                return response()->json(['success' => false, 'error' => ['message' => Config::get('constants.SOMETHING_WENT_WRONG')]], 422);
            }
        }

        $request->auth = $accessTokenData;
        $data = getLinkedInData($request->auth);
        return response()->json([
            "success" => true,
            "data" => $data
        ]);
    }
}