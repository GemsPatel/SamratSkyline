<?php

namespace App\Traits;
use App\Models\MobileVerifications;
use App\Models\User;
use Carbon\Carbon;
use App\Mail\MailOrderDetailToOpd;
use App\Models\Customer;
use App\Models\EmailVerification;
use App\Models\MobileVerification;
use Illuminate\Support\Facades\Mail;

trait SendSMSAndVerifyOTP
{
    protected function sendMessage($sendTo, $msg)
    {
        if( getField( 'configuration' , 'config_key', 'config_value', 'SEND_SMS' ) == 0)
            return true;
            
        $message = urlencode($msg);//$msg;
        $countryCode = '';//'91';
        $sendTo = $countryCode.$sendTo;
        $userName = getField( 'configuration' , 'config_key', 'config_value', 'MSG_USER_NAME' );//config('villezone.sms_service_username');
        $password = getField( 'configuration' , 'config_key', 'config_value', 'MSG_USER_PASSWORD' );//config('villezone.sms_service_password');
        $route = getField( 'configuration' , 'config_key', 'config_value', 'MSG_ROUTE' );//02;
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, "http://smslogin.pcexpert.in/api/mt/SendSMS?user=$userName&password=$password&senderid=VLZONE&channel=Trans&DCS=0&flashsms=0&number=$sendTo&text=$message&route=$route&PEID=1301159497953066343");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        
        // $head = curl_exec($ch);
        // echo $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        // $status = json_decode($head);
        // dd($status);
        return;// $this->checkMessageSendStatus( $status->JobId );
    }
    
    public function checkMessageSendStatus( $job="" )
    {
        $userName = getField( 'configuration' , 'config_key', 'config_value', 'MSG_USER_NAME' );
        $password = getField( 'configuration' , 'config_key', 'config_value', 'MSG_USER_PASSWORD' );
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, "http://smslogin.pcexpert.in/api/mt/GetDelivery?user=$userName&password=$password&jobid=$job");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        
        $head = curl_exec($ch);
        curl_close($ch);
        
        return json_decode($head);
    }

    /**
     * Undocumented function
     *
     * @param [type] $mobileNumber
     * @param [type] $verificationCode
     * @return void
     */
    public function verifyMobileVerificationCode($mobileNumber, $verificationCode) {
        $verificationMobileRecord = MobileVerification::where('mobile_number', $mobileNumber)->where('code', $verificationCode)->where('verified', 0)->first();//->whereNull('customer_id');

        if (!$verificationMobileRecord) {
            return false;
        }

        $verificationMobileRecord->verified = 1;
        $verificationMobileRecord->save();
        return true;
    }

    public function verifyEmailVerificationCode($email, $verificationCode) {
        $verificationEmailRecord = EmailVerification::where('email', $email)->where('code', $verificationCode)->where('verified', 0)->first();//->whereNull('customer_id');

        if (!$verificationEmailRecord) {
            return false;
        }

        $verificationEmailRecord->verified = 1;
        $verificationEmailRecord->save();
        return true;
    }

    public function verifyMobileVerificationCodeForForgotPassword($mobileNumber, $verificationCode) {
        $verificationMobileRecord = MobileVerification::where('mobile_number', $mobileNumber)->where('code', $verificationCode)->where('verified', 0)->whereNotNull('customer_id')->first();

        if (!$verificationMobileRecord) {
            return false;
        }

        $verificationMobileRecord->verified = 1;
        $verificationMobileRecord->save();
        return true;
    }

    public function verifyMobileVerificationCodeForUpdateMobileNumber($mobileNumber, $verificationCode) {
        $verificationMobileRecord = MobileVerification::where('mobile_number', $mobileNumber)->where('code', $verificationCode)->where('verified', 0)->where('customer_id', auth()->guard('customer-api')->user()->id)->first();

        if (!$verificationMobileRecord) {
            return false;
        }

        $verificationMobileRecord->verified = 1;
        $verificationMobileRecord->save();
        return $verificationMobileRecord;
    }

    function pushNotificationAndroid( $title="Notification", $message="", $deviceIds=array()){

        if( isEmptyArr( $deviceIds ) )
        {
            return true;
//             $deviceIds = Customer::whereNotNull('notification_token')->get()->pluck('notification_token')->toArray();
        }

        $url = 'https://fcm.googleapis.com/fcm/send';
    
        $apiKey = fireBaseServerKey();
            
        $fields = array (
            'registration_ids' => $deviceIds,
            'data' => array (
                "message" => $message,
                "title" => $title
            ),
            'notification' => array (
                "message" => $message,
                "title" => $title
            )
        );

        $headers = array(
            'Content-Type:application/json',
            'Authorization:key='.$apiKey
        );
                    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }
    
    function pushAdminNotificationAndroid( $title="Notification", $message=""){
        
        $deviceIds = Customer::whereNotNull('notification_token')->get()->pluck('notification_token')->toArray();
        
        $url = 'https://fcm.googleapis.com/fcm/send';
        
        $apiKey = fireBaseServerKey();
        
        $fields = array (
            'registration_ids' => $deviceIds,
            'data' => array (
                "message" => $message,
                "title" => $title
            ),
            'notification' => array (
                "message" => $message,
                "title" => $title,
            )
        );
        
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key='.$apiKey
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }

    /**
     * 
     */
    function pushAdminNotificationIOS( $title="Notification", $body="" )
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $serverKey = fireBaseServerKey();
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $serverKey;
        $notification = array('title' =>$title , 'text' => $body, 'sound' => 'default', 'badge' => '1');

        $deviceIds = Customer::whereNotNull('notification_token')->get()->pluck('notification_token')->toArray();
        if( COUNT( $deviceIds ) > 0 )
        {
            foreach( $deviceIds as $token )
            {
                $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
                $json = json_encode($arrayToSend);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
                //Send the request
                $response = curl_exec($ch);
                //Close request
                // if ($response === FALSE) {
                //     die('FCM Send Error: ' . curl_error($ch));
                // }
                curl_close($ch);
            }
        }
    }
    
}
