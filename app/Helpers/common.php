<?php

use App\Model\admin\Currencies;
use App\Models\Admin\Type;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Stevebauman\Location\Facades\Location;

/*
++++++++++++++++++++++++++++++++++++++++++++++
	display pagetitle and header title on browser
++++++++++++++++++++++++++++++++++++++++++++++
*/
function pgTitle($pgName)
{
	return ucwords(str_replace(array(0=>'-',1=>'_'),' ',$pgName));
}

/**
 * @Function:        <login>
 * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
 * @Created On:      <10-02-2020>
 * @Last Modified By:Gautam Kakadiya
 * @Last Modified:   Gautam Kakadiya
 * @Description:     <This function for @abstact function will check if form is posted>
 */
function isPost()
{
	if( $_SERVER['REQUEST_METHOD'] == "POST" || !empty($_POST) )
		return true;
	else
		return false;
}

/**
 * @Function:        <login>
 * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
 * @Created On:      <10-02-2020>
 * @Last Modified By:Gautam Kakadiya
 * @Last Modified:   Gautam Kakadiya
 * @Description:     <This function for >
 * This function decode ids and return in array.
 *basically it will decode using base64 algo.
 */
function _de($id)
{
	return base64_decode($id);
}

/**
 * @Function:        <login>
 * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
 * @Created On:      <10-02-2020>
 * @Last Modified By:Gautam Kakadiya
 * @Last Modified:   Gautam Kakadiya
 * @Description:     <This function for >
 *	This function encode ids and return in array.
 *	basically it will encode using base64 algo.
 */
function _en($id)
{
	return base64_encode($id);
}

/**
 * @Function:        <login>
 * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
 * @Created On:      <10-02-2020>
 * @Last Modified By:Gautam Kakadiya
 * @Last Modified:   Gautam Kakadiya
 * @Description:     <This function for >
 *	Load image from url. if not file exist then
 *	it will load default selected image.
 *	@params : $url -> URL of image [url will be relative].
 *			  $fl -> Flag stand for return image path only.
 *	@returrn : Path of image
 */
function load_image($url='')
{
	if( $url != '' && file_exists('./'.$url) )
		return url($url);
	else
		return url("public/images/no-image.jpg");
}

/**
 * @Function:        <login>
 * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
 * @Created On:      <10-02-2020>
 * @Last Modified By:Gautam Kakadiya
 * @Last Modified:   Gautam Kakadiya
 * @Description:     <This function for >
 *	Load image from url. if not file exist then
 *	it will load default selected image.
 *	@params : $url -> URL of image [url will be relative].
 *			  $fl -> Flag stand for return image path only.
 *	@returrn : Path of image
 */
function load_gif( $path='', $name='')
{
	$ip = \Request::ip();
	if( empty( $ip ) || $ip == "192.168.0.26" || $ip == "192.168.0.30" )
		$path =  'public/'.$path;
	
    	if( $name != '' && file_exists( $path.'/'.$name ) )
      	return asset( $path.'/'.$name );
	else
		return url("public/images/no-image.png");
}

/**
 * @Function:        <login>
 * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
 * @Created On:      <10-02-2020>
 * @Last Modified By:Gautam Kakadiya
 * @Last Modified:   Gautam Kakadiya
 * @Description:     <This function for @abstract Function will check if array is empty>
 */	
function isEmptyArr( $arr )
{
    if( is_array($arr) )
    {
        $arr = array_filter($arr);
        if ( !empty($arr) ) { return false; }
        else { return true; }
    }
    else 
		return false; 
}

/**
 * @Function:        <login>
 * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
 * @Created On:      <10-02-2020>
 * @Last Modified By:Gautam Kakadiya
 * @Last Modified:   Gautam Kakadiya
 * @Description:     <This function for @abstract function will convert timein seconds to string>
 */
function time2string($time)
{
    $second = 1;
    $minute = 60*$second;
    $hour   = 60*$minute;
    $day    = 24*$hour;
    
    $ans[0] = floor($time/$day);
    $ans[1] = floor(($time%$day)/$hour);
    $ans[2] = floor((($time%$day)%$hour)/$minute);
    $ans[3] = floor(((($time%$day)%$hour)%$minute)/$second);
    
    return ( !empty($ans[0]) ? $ans[0].' Day ': '' ).( !empty($ans[1]) ? $ans[1].' Hr ': '' ).( !empty($ans[2]) ? $ans[2].' Min ': '' ).( !empty($ans[3]) ? $ans[3].' Sec': '' );
}

/**
 * @Function:        <login>
 * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
 * @Created On:      <10-02-2020>
 * @Last Modified By:Gautam Kakadiya
 * @Last Modified:   Gautam Kakadiya
 * @Description:     <This function for @abstract fetch string within specified start and end>
 */
function fetchSubStr( $str, $start, $end, &$offsetI=0 )
{
	$pos1 = strpos( $str, $start );
	if( $pos1 !== FALSE )
	{
		$pos1 = $pos1 + strlen( $start );

		$pos2 = FALSE;
		if( !empty( $end ) )	
			$pos2 = strpos( $str, $end, $pos1 );
		
		if( $pos2 !== FALSE )
		{
			$offsetI = $pos2;
			return substr( $str, $pos1, ( $pos2 - $pos1 ) );
		}
		else
		{
			$offsetI = $pos1;
			return substr( $str, $pos1 );
		}
	}
}

/**
 * @Function:        <login>
 * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
 * @Created On:      <10-02-2020>
 * @Last Modified By:Gautam Kakadiya
 * @Last Modified:   Gautam Kakadiya
 * @Description:     <This function for @abstract fetch last substring within specified start and end>
 */
function fetchLastSubStr( $str, $start, $end, &$offsetI=0 )
{
	$pos1 = strrpos( $str, $start );
	if( $pos1 !== FALSE )
	{
		$pos1 = $pos1 + strlen( $start );

		$pos2 = FALSE;
		if( !empty( $end ) )
			$pos2 = strpos( $str, $end, $pos1 );

		if( $pos2 !== FALSE )
		{
			$offsetI = $pos2;
			return substr( $str, $pos1, ( $pos2 - $pos1 ) );
		}
		else
		{
			$offsetI = $pos1;
			return substr( $str, $pos1 );
		}
	}
}

/**
 * @Function:        <cmn_getURL>
 * @Author:          Gautam Kakadiya
 * @Created On:      <07-02-2020>
 * @Last Modified By:
 * @Last Modified: 
 * @Description:     <This methode create proper browser URL>
 */
function cmn_getURL( $url = "" )
{   
    if ( strpos( $url, 'http://') !== false) {
        //
    }
    else if ( strpos( $url, 'https://') !== false) {
        //
    }
    else
        $url = "http://".$url;
    
    return $url;
}

/**
 * @Function:        <startQueryLog>
 * @Author:          Gautam Kakadiya
 * @Created On:      <27-02-2020>
 * @Last Modified By:
 * @Last Modified:
 * @Description:     <This methode start query log>
 */
function startQueryLog()
{
    DB::enableQueryLog();
}

/**
 * @Function:        <displayQueryResult>
 * @Author:          Gautam Kakadiya
 * @Created On:      <27-02-2020>
 * @Last Modified By:Gautam Kakadiya
 * @Last Modified:
 * @Description:     <This methode create result array>
 */
function displayQueryResult()
{
    $query = DB::getQueryLog();
    pr($query);
}

/**
 * @Function:        <getURLSegmentValue>
 * @Author:          Gautam Kakadiya
 * @Created On:      <04-07-2020>
 * @Last Modified By: Gautam Kakadiya
 * @Last Modified:
 * @Description:     <This methode return segmant value>
 */
function getURLSegmentValue( $val=1 )
{
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    return $uri_segments[$val];
}

/**
 * Most cards use the Luhn algorithm for checksums:
 * check_cc() will return false if the card number isn’t valid and if it is valid, will return a string containing the type of card matched.
 */
function check_cc($cc, $extra_check = false){
    $cards = array(
        "visa" => "(4\d{12}(?:\d{3})?)",
        "amex" => "(3[47]\d{13})",
        "jcb" => "(35[2-8][89]\d\d\d{10})",
        "maestro" => "((?:5020|5038|6304|6579|6761)\d{12}(?:\d\d)?)",
        "solo" => "((?:6334|6767)\d{12}(?:\d\d)?\d?)",
        "mastercard" => "(5[1-5]\d{14})",
        "switch" => "(?:(?:(?:4903|4905|4911|4936|6333|6759)\d{12})|(?:(?:564182|633110)\d{10})(\d\d)?\d?)",
    );
    $names = array("Visa", "American Express", "JCB", "Maestro", "Solo", "Mastercard", "Switch");
    $matches = array();
    $pattern = "#^(?:".implode("|", $cards).")$#";
    $result = preg_match($pattern, str_replace(" ", "", $cc), $matches);
    if($extra_check && $result > 0){
        $result = (validatecard($cc))?1:0;
    }
    return ($result>0)?$names[sizeof($matches)-2]:false;
}

/**
 * Most cards use the Luhn algorithm for checksums:
 */
function validatecard($cardnumber) {
    $cardnumber=preg_replace("/\D|\s/", "", $cardnumber);  # strip any non-digits
    $cardlength=strlen($cardnumber);
    $parity=$cardlength % 2;
    $sum=0;
    for ($i=0; $i<$cardlength; $i++) {
      $digit=$cardnumber[$i];
      if ($i%2==$parity) $digit=$digit*2;
      if ($digit>9) $digit=$digit-9;
      $sum=$sum+$digit;
    }
    $valid=($sum%10==0);
    return $valid;
}

/**
 * 
 */
function getField($table, $field, $value, $where)
{
    $result = DB::table($table)->where($field, $where)->first();
    return $result->$value;
}

/**
 * 
 */
function fireBaseServerKey()
{
    return 'AAAA6CPQreA:APA91bGuCeFMECxwKX4Rx9A5DxKqXa2I3ds9LYri_caVDYze7lUfQm4y2zDvUCe7rsbV0kaX7vBgkPkcZu7Q0dUPKctkmHJ43Yt5-YRH1mk6BXbcr7S_qLsP_lX31KBp0vayb7SIpgkb';
}

/**
 * convert string in to proper format
 */
function convertStringToSlug( $str='' )
{
	return preg_replace( '/-+/', '-', preg_replace( '/[^a-z0-9-]+/', '-', trim( strtolower( $str ) ) ) );
}

/**
 * Say you were displaying the size of a file in PHP. You obviously get the file size in Bytes by using filesize().
 * Here is a simple function to convert Bytes to KB, MB, GB, TB :
 * @param [type] $size
 * @return void
 */
function convertToReadableSize($size){
	$base = log($size) / log(1024);
	$suffix = array("", "KB", "MB", "GB", "TB");
	$f_base = floor($base);
	return round(pow(1024, $base - floor($base)), 1) . $suffix[$f_base];
  }

/**
 * Undocumented function
 *
 * @param string $title
 * @param string $message
 * @return void
 */
function sendAndroidNotification( $title="Notification", $message=""){

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
 * Undocumented function
 *
 * @param string $title
 * @param string $message
 * @return void
 */
function sendIOSNotification( $title="Notification", $body="" )
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