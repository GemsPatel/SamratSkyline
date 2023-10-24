<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MobileVerificationRequest;
use App\Http\Resources\AccountResource;
use App\Http\Resources\LoginResource;
use App\Models\Admin\Plan;
use App\Models\Admin\PlanCountry;
use App\Models\Admin\RatingComment;
use App\Models\Admin\Title;
use App\Models\Admin\TitleGenre;
use App\Models\Customer;
use App\Models\CustomerLanguageMap;
use App\Models\EmailVerification;
use App\Models\Favourite;
use App\Models\MembershipPlanBuy;
use App\Models\MobileVerification;
use App\Rules\MatchOldPassword;
use App\Traits\SendSMSAndVerifyOTP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CustomerApiController extends Controller
{
    use SendSMSAndVerifyOTP;
    
    /**
     * @Function:        <verifyMobile>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <24-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for listen list remove.
     * API: 27
     * @return \Illuminate\Http\Response
     */
    public function verifyMobile(MobileVerificationRequest $request)
    {
        $inputs = $request->validate();

        if( $inputs['mobile_number'][0] == 0 )
        {
            return response()->json( ['data' => ['message' => 'Incorrect mobile phone number. Please try once more.'] ], 201 );
            $inputs['mobile_number'] = ltrim( $inputs['mobile_number'], '0' );
        }

        if( strlen( $inputs['mobile_number'] ) < 10 )
            return response()->json( ['data' => ['message' => 'Please provide a valid mobile phone number.' ] ], 201 );

        $user = Customer::where('mobile_number',$inputs['mobile_number'])->first();

        if( !empty( $user ) )
        {
            if($user->mpin == '' || $user->mpin == NULL) {
                $sentOTP = json_decode( $this->sendMobileOTP($request)->content(), true );
                return response()->json(['data' => ['message' => 'Reset your mpin by entering your otp.', 'OTP' => $sentOTP["data"]["OTP"], 'is_login' => 2]], 200);
            }
            if( $user->activation == 2 ) {
                return response()->json( ['data' => ['message' => 'Your account has been suspended; please contact support.', 'is_login' => 1 ] ], 201);
            } else if($request->mpin_reset) {
                $sentOTP = json_decode( $this->sendMobileOTP($request)->content(), true );
                return response()->json(['data' => ['message' => 'Reset your mpin by entering your otp.', 'OTP' => $sentOTP["data"]["OTP"]]], 200);
            }
            else if ($request->via_otp) {
                $sentOTP = json_decode( $this->sendMobileOTP($request)->content(), true );
                return response()->json(['data' => ['message' => 'Set your mpin and enter your otp.', 'is_login' => 1, 'OTP' => $sentOTP["data"]["OTP"]]], 200);
            }
            else {
                return response()->json(['data' => ['message' => 'To proceed with the login, enter your MPIN.', 'is_login' => 1]], 200);
            }
        }
        else
        {
            $sentOTP = json_decode( $this->sendMobileOTP($request)->content(), true );
            return response()->json(['data' => ['message' => 'OTP was successfully sent.', 'is_login' => 0, 'OTP' => $sentOTP["data"]["OTP"]]], 200);
        }
    }

    /**
     * @Function:        <sendOTP>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <24-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for listen list remove.
     * API: 2736
     * @return \Illuminate\Http\Response
     */
    public function sendOTP( Request $request) //MobileVerificationRequest
    {

        if( filter_var( $request->verify, FILTER_VALIDATE_EMAIL ) ) {
            return $this->sendEmailOTP( $request );
        }
        else {
            return $this->sendMobileOTP( $request, false );
        }
    }

    /**
     * @Function:        <sendMobileOTP>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <24-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for listen list remove.
     * API: 2727
     * @return \Illuminate\Http\Response
     */
    public function sendMobileOTP( Request $request, $checkCountry=true) //MobileVerificationRequest
    {
        if( $checkCountry ){
            $request->validate([
                'country' => ['required'],
                'verify' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            ]);
        } else {
            $request->validate([
                'verify' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            ]);
        }

        if( $request->verify[0] == 0 )
        {
            return response()->json( ['data' => ['message' => 'Incorrect mobile phone number. Please try once more.'] ], 201 );
            $inputs['mobile_number'] = ltrim( $request->verify, '0' );
        }

        if( strlen( $request->verify ) < 10 )
            return response()->json(['data' => ['message' => 'Please provide a valid mobile phone number.' ]], 201 );

        $user = Customer::where('mobile_number', $request->verify )->first();
        if( $user && $user->activation == 2 )
            return response()->json( ['data' => ['message' => 'Your account has been suspended; please contact support.'] ], 201);
        
        MobileVerification::where('mobile_number', $request->verify )->delete();

        $mobile = new MobileVerification();
        $mobile->code = mt_rand(1000,9999);
        $mobile->mobile_number = $request->verify;
        $mobile->save();
        
        // try {
        //     if( isset( $request->signCode ) && !empty( $request->signCode ) )
        //         $message = "<#> Villezone: Your code is ".$mobile->code." \n\r".$request->signCode;
        //     else 
        //         $message = 'Thanks to be a part of our villezone family, Your OTP is: '.$mobile->code;
            
        //     $this->sendMessage($inputs['verify'], $message, "1307161553396077567");
        // } catch (\Exception $e) {
        //     Log::error($e);
        //     return response(['error' => ['message' => 'Please try again if something went wrong.', 'is_login' => 2 ]], 500);
        // }

        return response()->json(['data' => ['message' => 'OTP was successfully sent.', 'OTP' => $mobile->code ]], 200 );
    }

    /**
     * @Function:        <verifyOTP>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <24-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for listen list remove.
     * API: 2737
     * @return \Illuminate\Http\Response
     */
    public function verifyOTP( Request $request) //Mobile/EmailVerificationRequest
    {
        if( $request->email != "" && $request->mobile_number == ""){
            return $this->verifyEmailOTP( $request );
        } else if( $request->email == "" && $request->mobile_number != ""){
            return $this->verifyMobileOTP( $request );
        } else {
            return response()->json( ['data' => ['message' => 'Please provide a valid mobile or email.'] ], 201 );
        }
    }

    /**
     * @Function:        <verifyMobileOTP>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <24-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for listen list remove.
     * API: 27
     * @return \Illuminate\Http\Response
     */
    public function verifyMobileOTP( Request $request)
    {
        $inputs = $request->validate([
            'mobile_number' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'code' => ['required', 'numeric'],
        ]);
        
        if( $inputs['mobile_number'][0] == 0 )
        {
            return response()->json( ['data' => ['message' => 'Please provide a valid mobile phone number.'] ], 201 );
            $inputs['mobile_number'] = ltrim( $inputs['mobile_number'], '0' );
        }

        $mobileNumberVerify = $this->verifyMobileVerificationCode($inputs['mobile_number'], $inputs['code']);
        
        if ($mobileNumberVerify){
            $checkUserExist = Customer::where('mobile_number', $inputs['mobile_number'])->first();
            if ($checkUserExist)
            {
                return response()->json( ['data' => ['message' => 'The OTP was successfully validated.', 'is_register' => 0, 'pass_code' => $checkUserExist->pass_code, 'customer' => $checkUserExist ] ], 200);
            }
            else
                return response()->json(['data' => ['message' => 'The OTP was successfully validated. Register to receive all benefits.', 'is_register' => 1, 'pass_code' => 'GENTNULL' ]], 200);
        }
        
        return response(['error' => ['message' => 'The OTP is incorrect. Please try once more.'] ], 422);
    }

    /**
     * @Function:        <sendEmailOTP>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <24-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for listen list remove.
     * API: 27
     * @return \Illuminate\Http\Response
     */
    public function sendEmailOTP( Request $request) //MobileVerificationRequest
    {
        $request->validate([
            'verify' => ['required', 'email'],
        ]);

        $user = Customer::where('email', $request->verify )->first();
        if( $user && $user->status == 2 )
            return response()->json( ['data' => ['message' => 'Your account has been suspended; please contact support.'] ], 201);
        
        $code =mt_rand(1000,9999);
        // try {
        //     $mail_details = [
        //         'subject' => 'Account OTP',
        //         'body' => 'Your Email verify OTP is : '. $code
        //     ];
            
        //     Mail::send('emails.verify-register', $mail_details, function ($message) use ($request) {
        //         $message->from('postmaster@mailinator.com', 'Trigma Team');
        //         $message->to( $request->verify )->subject("Verify OTP Account");
        //     });

            EmailVerification::where('email', $request->verify )->delete();
             $email = new EmailVerification();
             $email->code = $code;
             $email->email = $request->verify;
             $email->save();

        // } catch (\Exception $e) {
        //     Log::error($e);
        //     return response(['error' => ['message' => 'Please try again if something went wrong.', 'is_login' => 2 ]], 500);
        // }

        return response()->json(['data' => ['message' => 'OTP sent successfully.', 'OTP' => $code ]], 200 );
    }

    /**
     * @Function:        <verifyEmailOTP>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <24-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for listen list remove.
     * API: 27
     * @return \Illuminate\Http\Response
     */
    public function verifyEmailOTP( Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'code' => ['required', 'numeric'],
        ]);
        
        $emailVerify = $this->verifyEmailVerificationCode( $request->email, $request->code );
        
        if ($emailVerify){
            $checkUserExist = Customer::where('email', $request->email)->first();
            if ($checkUserExist)
            {
                return response()->json( ['data' => ['message' => 'The OTP was successfully validated.', 'is_register' => 0, 'pass_code' => $checkUserExist->pass_code, 'customer' => $checkUserExist ] ], 200);
            }
            else
                return response()->json(['data' => ['message' => 'The OTP was successfully validated. Register to receive all benefits.', 'is_register' => 1, 'pass_code' => 'GENTNULL' ]], 200);
        }
        
        return response(['error' => ['message' => 'The OTP is incorrect. Please try once more.'] ], 422);
    }

    /**
     * @Function:        <createCustomer>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <24-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for listen list remove.
     * API: 27
     * @return \Illuminate\Http\Response
     */
    public function createCustomer( Request $request ) 
    {
        $loginToken = [];
        if( $request->isRegister == 2 || $request->isRegister == 3 ){
            $request->validate([
                'name' => ['required'],
                'email' => ['required', 'email'],
            ]);

            $verifiedEmail = Customer::where('email', $request->email)->first();

            if ($verifiedEmail)
                return response(['error' => ['message' => 'This email address is already on file with us. Please choose another.']], 403);

            $customer = new Customer();
            if( !empty( $request->refer_code ) )
            {
                $referVerification = Customer::where( 'refer_code', strtoupper( $request->refer_code ) )->first();

                if( !$referVerification )
                    return response(['error' => ['message' => 'Please double-check your referral code first.'] ], 401 );
                else
                    $customer->reference_id = $referVerification->id;
            }

            $customer->refer_code = strtoupper( "GENT".substr( uniqid(), 0, 8 ) );//generateRandomString(8);
            $customer->email = $request->email;
            $customer->name = $request->name;
            if( $request->isRegister == 2 )
                $customer->facebook_token = $request->access_token;

            if( $request->isRegister == 3 )
                $customer->apple_token = $request->access_token;

            $customer->save();

            $deviceID = $request->device_id ?? '';
            $notification_token = $request->notification_token;
            $customer_id = $customer->id;//auth()->guard('customer-api')->user()->id;
            
            if( $deviceID )
            {
                $customer = Customer::find( $customer_id );
                $customer->device_id = $deviceID['device_id'];
                $customer->notification_token = $notification_token['notification_token'];
                $customer->save();
            }

            return [
                'message' => 'Account successfully created and logged in.',
                'token_type' => 'bearer',
                'access_token' => $request->access_token,
                'user_detail' => $customer,
            ];
            
        } else {
            $request->validate([
                'name' => ['required'],
                'country_id' => ['required'],
                'gender' => ['required'],
                'dob' => ['required'],
                'mobile_number' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
                'email' => ['required', 'email'],
                'password' => ['required','min:6', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'],// 'confirmed'
            ]);

            $verifiedEmail = Customer::where('email', $request->email)->first();

            if ($verifiedEmail)
                return response(['error' => ['message' => 'This email address is already on file with us. Please choose another.']], 403);

            $verifiedMobile = Customer::where('mobile_number', $request->mobile_number)->first();

            if ($verifiedMobile)
                return response(['error' => ['message' => 'This mobile is already on file with us. Please choose another.']], 403);

            $customer = new Customer();
            if( !empty( $request->refer_code ) )
            {
                $referVerification = Customer::where( 'refer_code', strtoupper( $request->refer_code ) )->first();

                if( !$referVerification )
                    return response(['error' => ['message' => 'Please double-check your referral code first.'] ], 401 );
                else
                    $customer->reference_id = $referVerification->id;
            }

            if( $request->isRegister == 1 ){
                $verifiedNumber = MobileVerification::where('mobile_number', $request->mobile_number)->where('verified', 1)->first();//->whereNull('customer_id')
                if (!$verifiedNumber){
                    return response(['error' => ['message' => 'Please first confirm your mobile phone number.'] ], 403);
                }
                MobileVerification::where('mobile_number', $request->verify )->delete();//delete verification mobile number
            }

            if( $request->isRegister == 0 ){
                $verifiedNumber = EmailVerification::where('email', $request->email)->where('verified', 1)->first();//->whereNull('customer_id')
                if (!$verifiedNumber){
                    return response(['error' => ['message' => 'Please first confirm your email address.'] ], 403);
                }
                EmailVerification::where('email', $request->email )->delete();//delete verification email
            }

            $customer->password = $request->mobile_number;
            $customer->refer_code = strtoupper( "GENT".substr( uniqid(), 0, 8 ) );//generateRandomString(8);
            $customer->email = $request->email;
            $customer->csrf_code = $request->password;
            $customer->name = $request->name;
            $customer->country_id = $request->country_id;
            $customer->mobile_number = $request->mobile_number;
            $customer->gender = $request->gender;
            $customer->dob = $request->dob;
            $customer->isRegister = $request->isRegister;
            $customer->password = Hash::make($request->password);
            $customer->save();

            $loginDetails = ['mobile_number' => $request->mobile_number, 'password' => $request->password];
            $loginToken = $this->loginAfterRegister($loginDetails, $request);

            $deviceID = $request->device_id;
            $notification_token = $request->notification_token;
            $customer_id = auth()->guard('customer-api')->user()->id;
            
            if( $deviceID )
            {
                $customer = Customer::find( $customer_id );
                $customer->device_id = $deviceID['device_id'];
                $customer->notification_token = $notification_token['notification_token'];
                $customer->save();
            }
            
            // if (array_key_exists('email', $inputs))
            //     Mail::to($inputs['email'])->queue(new WelcomeCustomer($inputs));
        }
        return new LoginResource(['access_token' => $loginToken, 'message' => 'Account successfully created and logged in.']);
    }

    /**
     * @Function:        <loginAfterRegister>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <24-11-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for listen list remove.
     * API: 27
     * @return \Illuminate\Http\Response
     */
    public function loginAfterRegister( $credentials, $request ) 
    {
        if (!$token = auth()->guard('customer-api')->attempt($credentials)) {
            return response()->json(['error' => 'Something is wrong.'], 401);
        }
        return $token;
    }

    /**
     * @Function:        <getUserDetails>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <08-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display a details of the logged user.
     * API: 2762
     * @return \Illuminate\Http\Response
     */
    public function getUserDetails()
    {
        $customer = auth()->guard('customer-api')->user();
        return response( [ 'data' => ['user' => $customer], 'message' => 'The data was successfully retrieved.' ] );
    }

    /**
     * @Function:        <updateProfileDetails>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <08-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display a details of the logged user.
     * API: 2765
     * @return \Illuminate\Http\Response
     */
    public function updateProfileDetails(Request $request)  
    {
        $customer = auth()->guard('customer-api')->user();
        if( $customer ){
            $request->validate([
                'name' => ['required'],
                'gender' => ['required'],
                'dob' => ['required'],
            ]);
    
            $customer = Customer::find( auth()->guard('customer-api')->user()->id );
            $customer->name = $request->name;
            $customer->gender = $request->gender;
            $customer->dob = $request->dob;
            $customer->save();
    
            return response()->json( ['data' => ['message' => 'Your profile information has been successfully updated.', 'customer' => $customer ] ] );
        } else {
            return response()->json( ['data' => ['result' =>[] ], 'status' => 0, 'message' => "Your app session expired, please login again." ], 401);
        }
    }

    /**
     * @Function:        <getRateReviewList>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <2-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for RateReview list.
     * API: 2749
     * @return \Illuminate\Http\Response
     */
    public function getRateReviewList( Request $request, $titleId=0 )
    {
        $customer = auth()->guard('customer-api')->user();
        if( $customer ){

            $result = RatingComment::where([ 'customer_id' => $customer->id, 'parent_id' => 0, 'title_id' => $titleId ] )->get();//with('title')->
            if( $result ){
                foreach( $result as $k=>$ar ){
                    $result[$k]['total_replies'] = RatingComment::where([ 'customer_id' => $customer->id, 'parent_id' => $ar->id ] )->count();
                    $result[$k]['replies'] = RatingComment::where([ 'customer_id' => $customer->id, 'parent_id' => $ar->id ] )->get();//In the feature version, a recursive function can be required. ( getRecursiveRatingCommentData() )
                }
            }
            return response()->json( ['data' => ['result' =>$result ], 'status' => 1, 'message' => 'The data was successfully retrieved.' ], 200);
        } else {
            return response()->json( ['data' => ['result' =>[] ], 'status' => 0, 'message' => "Your app session expired, please login again." ], 401);
        }
    }

     /**
     * @Function:        <postRateReviewList>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <2-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for RateReview list.
     * API: 2749
     * @return \Illuminate\Http\Response
     */
    public function postRateReviewList( Request $request )
    {
        $customer = auth()->guard('customer-api')->user();
        if( $customer ){

            $max = getConfigurationfield('COMMENT_ALLOW_CHARACTER');
            $request->validate([
                'comment' => ['required','min:1', 'max:'.$max ]
            ]);

            $rc = new RatingComment();
            $rc->type_id = $request->type_id;
            $rc->title_id = $request->title_id;
            $rc->comment_id = $request->comment_id;
            $rc->music_id = $request->music_id;
            $rc->customer_id = $customer->id;
            $rc->user_type = 1;
            $rc->rating = $request->rating;
            $rc->comment = $request->comment;
            $rc->ip_address = $request->ip();
            $rc->save();
            return response()->json( ['data' => ['result' =>[] ], 'status' => 1, 'message' => 'Your review was successfully submitted.' ], 200);
        } else {
            return response()->json( ['data' => ['result' =>[] ], 'status' => 0, 'message' => "Your app session expired, please login again." ], 401);
        }
    }

    /**
     * @Function:        <childPersonalMessage>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <05-01-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for RateReview list.
     * API: 2742
     * NOT SURE WHAT THIS MEANS.  
     * The closes to personal messages we have is that someone can reply to another person's review of a book as seen in the Figma designs under Library >> Book Details
     * @return \Illuminate\Http\Response
     */
    public function childPersonalMessage( Request $request )
    {
        $customer = auth()->guard('customer-api')->user();
        if( $customer ){

            $max = getConfigurationfield('COMMENT_ALLOW_CHARACTER');
            $request->validate([
                'comment' => ['required','min:1', 'max:'.$max ]
            ]);
            
            //get old comment details
            $oldRC = RatingComment::find( $request->id );
            if( $oldRC ){
                $rc = new RatingComment();
                $rc->type_id = $oldRC->type_id;
                $rc->title_id = $oldRC->title_id;
                $rc->comment_id = $oldRC->comment_id;
                $rc->music_id = $oldRC->music_id;
                $rc->parent_id = $oldRC->id;
                $rc->customer_id = $oldRC->customer_id;
                $rc->user_type = 1;
                $rc->rating = 0;//$request->rating;
                $rc->comment = $request->comment;
                $rc->ip_address = $request->ip();
                $rc->save();
            }
            return response()->json( ['data' => ['result' => $rc ], 'status' => 1, 'message' => 'Your review was successfully submitted.' ], 200);
        } else {
            return response()->json( ['data' => ['result' => [] ], 'status' => 0, 'message' => "Your app session expired, please login again." ], 401);
        }
    }

    /**
     * @Function:        <deleteRateReview>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <23-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for favourite list.
     * API: 2749
     * @return \Illuminate\Http\Response
     */
    public function deleteRateReview( $id )
    {
        $customer = auth()->guard('customer-api')->user();
        if( $customer ){
            // RatingComment::destroy( $id );
            RatingComment::where( [ 'id' => $id ] )->orWhere([ 'parent_id' => $id ])->delete();
            return response()->json( ['data' => ['result' =>[] ], 'status' => 1, 'message' => 'Your comment has been successfully deleted.' ], 200);
        } else {
            return response()->json( ['data' => ['result' =>[] ], 'status' => 0, 'message' => "Your app session expired, please login again." ], 401);
        }
    }

    /**
     * @Function:        <getPlanList>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <24-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display a listing of the resource.
     * API: 2725
     * @return \Illuminate\Http\Response
     */
    public function getPlanList()
    {
        return response()->json( ['data' => ['result' => Plan::with('country_plan')->where( [ 'status' => 1 ] )->get() ], 'message' => 'The data was successfully retrieved.' ], 200);
    }

    /**
     * @Function:        <upgradePlan>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <24-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display a listing of the resource.
     * API: 2726
     * @return \Illuminate\Http\Response
     */
    public function upgradePlan( Request $request )
    {
        $customer = auth()->guard('customer-api')->user();
        if( $customer ){

            if( $request->reference ){

                //get customer old purchase history
                $oldHitstory = MembershipPlanBuy::where( [ 'customer_id' => $customer->id, 'activation' => 1 ] )->first();
                if( $oldHitstory ){
                    $oldHitstory->activation = 3;
                    $oldHitstory->save();
                    // MembershipPlanBuy::query()->where( 'activation', 1 )->update(['activation' => 3]);//update running membership activation status to new purchase membership plan
                }
                //get pan information
                $getPlanInfo = Plan::find($request->plan_id);
    
                //get pan country information
                $getPlanCountryInfo = PlanCountry::where( 'plan_id', $request->plan_id)->get();
                $getPlanInfo['plan_country'] = $getPlanCountryInfo;
    
                $member = new MembershipPlanBuy();
                $member->plan_id = $request->plan_id;
                $member->customer_id = $customer->id;
                $member->amount = $request->amount;
                $member->payment_id = $request->payment_id;
                $member->txnid = $request->txnid;

                /**
                 * calculate membership validity
                 */
                $member->start_date = date('Y-m-d');
                $member->plan_mode = $getPlanInfo->plan_mode;
                $member->validity = $getPlanInfo->validity;
                $member->trial_days = $getPlanInfo->trial_days;
                $total_days = ( $getPlanInfo->validity + $getPlanInfo->trial_days );
                $member->total_days = $total_days;
                $member->extra_days = 0;
                $member->end_date = date( 'Y-m-d', strtotime("+$total_days day", time() ) );

                $member->plan_info = $getPlanInfo;
                $member->service_provider = $request->service_provider;
                $member->reference = $request->reference;
                $member->error = $request->error;
                $member->name_on_card = $request->name_on_card;
                $member->card_num = $request->card_num;
                $member->payment_type = $request->payment_type;
                $member->activation = 0;
                $member->save();
                
                return response()->json( ['data' => ['result' =>$member ], 'status' => 1, 'message' => "Your membership plan was successfully added to your account." ], 200);
            }
            else {
                return response()->json( ['data' => ['result' =>[] ], 'status' => 0, 'message' => "No reference supplied." ], 200);
            }
        } else {
            return response()->json( ['data' => ['result' =>[] ], 'status' => 0, 'message' => "Your app session expired, please login again." ], 401);
        }
    }

    /**
     * @Function:        <submitCustomerSelectedLanguage>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <25-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for store user selected category.
     * API: 27
     * @return \Illuminate\Http\Response
     */
    public function submitCustomerSelectedLanguage( Request $request )
    {
        $request->validate([
            'selection' => ['required', 'array', 'min:3']
        ]);

        $catArr = $request->selection;
        foreach( $catArr as $id ){
            $cat = new CustomerLanguageMap();
            $cat->customer_id = auth()->guard('customer-api')->user()->id;
            $cat->language_id = $id;
            $cat->save();
        }
        return response()->json( ['data' => ['result' => [] ], 'message' => 'The data was successfully submited.' ], 200);
    }

    /**
     * @Function:        <getCustomerSelectedLanguage>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <25-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for fetch user selected category.
     * API: 27
     * @return \Illuminate\Http\Response
     */
    public function getCustomerSelectedLanguage()
    {
        $customer = auth()->guard('customer-api')->user();
        if( $customer ){
            $catArr = CustomerLanguageMap::with('language')->where( 'customer_id', $customer->id )->get();
            return response()->json( ['data' => ['result' => [$catArr] ], 'message' => 'The data was successfully submited.' ], 200);
        } else {
            return response()->json( ['data' => ['result' =>[] ], 'status' => 0, 'message' => "Your app session expired, please login again." ], 401);
        }
    }

    /**
     * @Function:        <updatePassword>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <03-01-2022>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for fetch user selected category.
     * API: 27
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request) {
        $customer = auth()->guard('customer-api')->user();
        if( $customer ){
            $request->validate([
                'password' => ['required', new MatchOldPassword],
                'new_password' => ['required', 'min:6', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'],
                'new_confirm_password' => ['same:new_password'],
            ]);

            Customer::find($customer->id)->update(['password'=> Hash::make($request->new_password)]);
            return response()->json( ['data' => ['result' => [] ], 'message' => 'Password change successfully.' ], 200);
        } else {
            return response()->json( ['data' => ['result' =>[] ], 'status' => 0, 'message' => "Your app session expired, please login again." ], 401);
        }
    }

    /**
     * @Function:        <loginWithFacebook>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <07-01-2022>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for login with facebook.
     * API: 2728
     * @return \Illuminate\Http\Response
     */
    public function loginWithFacebook(Request $request) {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
        ]);

        $verifiedEmail = Customer::where('email', $request->email)->first();

        if ($verifiedEmail)
            return response(['error' => ['message' => 'This email address is already on file with us. Please choose another.']], 403);

        $customer = new Customer();
        if( !empty( $request->refer_code ) )
        {
            $referVerification = Customer::where( 'refer_code', strtoupper( $request->refer_code ) )->first();

            if( !$referVerification )
                return response(['error' => ['message' => 'Please double-check your referral code first.'] ], 401 );
            else
                $customer->reference_id = $referVerification->id;
        }

        $customer->refer_code = strtoupper( "GENT".substr( uniqid(), 0, 8 ) );//generateRandomString(8);
        $customer->email = $request->email;
        $customer->name = $request->name;
        $customer->isRegister = 3;
        $customer->facebook_token = $request->access_token;
        $customer->save();

        $deviceID = $request->device_id ?? '';
        $notification_token = $request->notification_token;
        $customer_id = $customer->id;//auth()->guard('customer-api')->user()->id;
        
        if( $deviceID )
        {
            $customer = Customer::find( $customer_id );
            $customer->device_id = $deviceID['device_id'];
            $customer->notification_token = $notification_token['notification_token'];
            $customer->save();
        }

        return [
            'message' => 'Account successfully created and logged in.',
            'token_type' => 'bearer',
            'access_token' => $request->access_token,
            'user_detail' => $customer,
        ];
    }

    /**
     * @Function:        <loginWithApple>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <07-01-2022>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for login with apple.
     * API: 2730
     * @return \Illuminate\Http\Response
     */
    public function loginWithApple(Request $request) {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
        ]);

        $verifiedEmail = Customer::where('email', $request->email)->first();

        if ($verifiedEmail)
            return response(['error' => ['message' => 'This email address is already on file with us. Please choose another.']], 403);

        $customer = new Customer();
        if( !empty( $request->refer_code ) )
        {
            $referVerification = Customer::where( 'refer_code', strtoupper( $request->refer_code ) )->first();

            if( !$referVerification )
                return response(['error' => ['message' => 'Please double-check your referral code first.'] ], 401 );
            else
                $customer->reference_id = $referVerification->id;
        }

        $customer->refer_code = strtoupper( "GENT".substr( uniqid(), 0, 8 ) );//generateRandomString(8);
        $customer->email = $request->email;
        $customer->name = $request->name;
        $customer->isRegister = 4;
        $customer->apple_token = $request->access_token;
        $customer->save();

        $deviceID = $request->device_id ?? '';
        $notification_token = $request->notification_token;
        $customer_id = $customer->id;//auth()->guard('customer-api')->user()->id;
        
        if( $deviceID )
        {
            $customer = Customer::find( $customer_id );
            $customer->device_id = $deviceID['device_id'];
            $customer->notification_token = $notification_token['notification_token'];
            $customer->save();
        }

        return [
            'message' => 'Account successfully created and logged in.',
            'token_type' => 'bearer',
            'access_token' => $request->access_token,
            'user_detail' => $customer,
        ];
    }

    /**
     * @Function:        <newReleases>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <07-01-2022>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for login with facebook.>
     * API: 
     * @return \Illuminate\Http\Response
     */
    public function newReleases(Request $request) {
        if(isset($request->category)) {
            $titlesIdFromCategory = TitleGenre::where('category_id', $request->category)->pluck('title_id')->toArray();
            $titles = Title::with('type')->where('membership_type' , 1)->whereIn('id', $titlesIdFromCategory)->orderBy('created_at', 'DESC')->limit(20)->get();
        } else {
            $titles = Title::with('type')->where('membership_type' , 1)->orderBy('created_at', 'DESC')->limit(20)->get();
        }
        return response()->json( ['data' => ['result' => $titles ], 'message' => 'New release get successfully.' ], 200);
    }
}
