<?php

namespace App\Http\Controllers;

use App\Models\Admin\AdminMenu;
use App\Models\Admin\Analytics;
use App\Models\Admin\Blogs;
use App\Models\Admin\Categories;
use App\Models\Admin\Configuration;
use App\Models\Admin\Country;
use App\Models\Admin\Language;
use App\Models\Admin\Permission;
use App\Models\Notification;
use DateTime;
use Twilio\Rest\Client;
use ZipArchive;
use Cion\TextToSpeech\Facades;
use Cion\TextToSpeech\Facades\TextToSpeech;
use Illuminate\Support\Facades\File;
use App\Mail\InfoEmail;
use App\Models\Admin\Home;
use App\Models\Admin\HomeMaintanance;
use App\Models\Admin\Maintanance;
use App\Models\Admin\MaintananceReport;
use App\Models\EmailNotification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class CronController extends Controller
{
    /**
     *
     */
    public function getXMLMP3(){
        // $rss=simplexml_load_file('https://anchor.fm/s/e118b50/podcast/rss');
        $rss=simplexml_load_file('https://feeds.buzzsprout.com/1670911.rss');
        dd($rss);
        foreach ($rss->channel->item as $item) {
            if (isset($item->enclosure)) {
                pr($item);
                // echo $item->enclosure['url'].'<br>';
            }
        }
    }

    /**
     * test function
     */
    public function updateCountryFlag()
    {
        return TextToSpeech::source('website')
            ->convert('https://splendid.shreegurve.tech/view/5-ways-to-build-resilient-leadership-in-challenging-times');

        $countryArr = Country::all();

        foreach( $countryArr as $ar ){
            $ar->image = "public/country/".$ar->sortname.".png";
            $ar->save();
        }
    }

    /**
     * @Function:        <sendAndroidNotification>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <04-01-2022>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Send Android notification in every 5 minutes>.
     * API: 2753
     * @return \Illuminate\Http\Response
     */
    function sendAndroidNotification()
    {
        $notification = Notification::where( ['status' => 1, 'is_android_send' => 0 ] )->first();
        if( !empty( $notification ) )
        {
            sendAndroidNotification( $notification->title, $notification->message );
            $notification->is_android_send = 1;
            $notification->save();
        }
    }

    /**
     * @Function:        <sendIOSNotification>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <04-01-2022>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Send IOS notification in every 5 minutes>.
     * API: 2753
     * @return \Illuminate\Http\Response
     */
    function sendIOSNotification()
    {
        $notification = Notification::where( ['status' => 1, 'is_ios_send' => 0 ] )->first();
        if( !empty( $notification ) )
        {
            sendIOSNotification( $notification->title, $notification->message );
            $notification->is_android_send = 1;
            $notification->save();
        }
    }

    /**
     * @Function:        <Generate Country Alias by name>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <26-01-2022>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for generate country alias by its name>.
     * API: 2753
     * @return \Illuminate\Http\Response
     */
    function generateCountryAlias()
    {
        $countryArr = Country::all();
        foreach( $countryArr as $ar )
        {
            $ar->alias = convertStringToSlug( $ar->name );
            $ar->save();
        }
    }

    /**
     * @Function:        <Generate Country Alias by name>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <26-01-2022>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for generate country alias by its name>.
     * API: 2753
     * @return \Illuminate\Http\Response
     */
    function generateLanguageAlias()
    {
        $languageArr = Language::all();
        foreach( $languageArr as $ar )
        {
            $ar->alias = convertStringToSlug( $ar->name );
            $ar->save();
        }
    }

    /**
     * @Function:        <generateAdminMenuSeeder>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <26-01-2022>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for generate country alias by its name>.
     * API: 2753
     * @return \Illuminate\Http\Response
     */
    function generateAdminMenuSeeder()
    {
        $languageArr = AdminMenu::all();
        foreach( $languageArr as $ar )
        {
            echo "['id' => ".$ar->id.",  'class_name' => '".$ar->class_name."', 'parent_id' => ".$ar->parent_id.", 'name' => '".$ar->name."', 'slug' => '".$ar->slug."', 'icon' => '".$ar->icon."', 'status' => ".$ar->status.", 'sort_order' => ".$ar->sort_order.",  'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],<br>";
        }
    }

    /**
     * @Function:        <generateConfigurationSeeder>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <26-01-2022>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for generate country alias by its name>.
     * API: 2753
     * @return \Illuminate\Http\Response
     */
    function generateConfigurationSeeder()
    {
        $languageArr = Configuration::all();
        foreach( $languageArr as $ar )
        {
            echo "['id' => ".$ar->id.", 'config_key' => '".$ar->config_key."', 'config_value'=> '".$ar->config_value."',  'status' => ".$ar->status.", 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],<br>";
        }
    }

    /**
     * @Function:        <generateAdminPermissionSeeder>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <26-01-2022>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for generate country alias by its name>.
     * API: 2753
     * @return \Illuminate\Http\Response
     */
    function generateAdminPemissionSeeder()
    {
        $languageArr = Permission::all();
        foreach( $languageArr as $ar )
        {
            echo "['id' => ".$ar->id.",  'menu_id' => '".$ar->menu_id."', 'user_id' => ".$ar->user_id.", 'role_id' => '".$ar->role_id."', 'add' => '".$ar->add."', 'edit' => '".$ar->edit."', 'delete' => ".$ar->delete.", 'view' => ".$ar->view.",  'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],<br>";
        }
    }

    /**
     * @Function:        <generateAdminMenuSeeder>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <11-02-2022>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for generate country alias by its name>.
     * API: 2753
     * @return \Illuminate\Http\Response
     */
    function generateCategorySeeder()
    {
        $languageArr = Categories::all();
        foreach( $languageArr as $ar )
        {
            echo "['id' => ".$ar->id.",  'parent_id' => '".$ar->parent_id."', 'title' => '".$ar->title."', 'slug' => '".$ar->slug."', 'image' => '".$ar->image."', 'status' => ".$ar->status.", 'sort_order' => ".$ar->sort_order.",  'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],<br>";
        }
    }

    /**
     *
     */
    public function testTextToSpeech(){
        // convert website articles & blog posts to an audio file
        return TextToSpeech::source('website')
            ->convert('https://medium.com/cloud-academy-inc/an-introduction-to-aws-polly-s3-and-php-479490bffcbd');
    }

    /**
     * Generate txt file as analytics format
     */
    public function storeTXTFile(){
        // return true;
        try {
            // Get the path to the storage folder
            $storagePath = storage_path();

            // Get all files from the storage folder
            $allFiles = File::allFiles($storagePath);

            // Filter only .txt files
            $txtFiles = array_filter($allFiles, function ($file) {
                return $file->getExtension() === 'txt';
            });

            // Process each .txt file
            foreach ($txtFiles as $txtFile) {

                $date = fetchSubStr( $txtFile, 'liveIPs-', '.txt' );

                // Read the contents of each .txt file // Create a file handle
                $fileHandle = fopen( $txtFile, 'r');

                if ($fileHandle) {
                    // Read the file line by line
                    while (($line = fgets($fileHandle)) !== false) {
                        // Process each line
                        $lineArr = json_decode( $line, 1 );
                        $analytics = new Analytics();
                        $analytics->areaCode = $lineArr['areaCode'];
                        $analytics->cityName = $lineArr['cityName'];
                        $analytics->countryCode = $lineArr['countryCode'];
                        $analytics->countryName = $lineArr['countryName'];
                        $analytics->ip = $lineArr['ip'];
                        $analytics->isoCode = $lineArr['isoCode'];
                        $analytics->latitude = $lineArr['latitude'];
                        $analytics->longitude = $lineArr['longitude'];
                        $analytics->metroCode = $lineArr['metroCode'];
                        $analytics->postalCode = $lineArr['postalCode'];
                        $analytics->regionCode = $lineArr['regionCode'];
                        $analytics->regionName = $lineArr['regionName'];
                        $analytics->zipCode	 = $lineArr['zipCode'];
                        $analytics->created_at = date( 'Y-m-d', strtotime( $date ) );
                        $analytics->save();
                    }

                    // Close the file handle after reading
                    fclose($fileHandle);
                }
            }

        } catch (\Exception $e) {
            // Handle any exceptions that might occur during file reading
            // ...
        }
    }

    /**
     * Email blog notification send in every mid night
     */
    public function publishBlogPost()
    {
		$updateEmailNotification = [];
        $usersToNotify = EmailNotification::select( 'id', 'customer_name', 'email', 'is_send_notification' )
        ->where( [
            'status' => 1,
            'is_send_notification' => 1,
            'un_subscribe' => 0
        ] )
        ->limit( 49 )
        ->inRandomOrder()
        ->get();

        if( !$usersToNotify ){//revert all email notification status
            EmailNotification::where( [
                'status' => 1,
                'is_send_notification' => 0,
                'un_subscribe' => 0
            ] )
            ->update( ['is_send_notification' => 1] );
        }

        $content = Blogs::select( 'id', 'title', 'short_url', 'image', 'short_description' )
        ->where([
            'is_send_template' => 0,
            'status' => 1
        ])
        ->first();

        if( !$content ){ //revert all blog status
            Blogs::where( [
                'is_send_template' => 1
            ] )
            ->update( ['is_send_template' => 0 ] );
        }

        if( $content && $usersToNotify ){
            foreach ($usersToNotify as $k=>$user) {
                Mail::to( $user->email )->send(new InfoEmail( $user, $content ));
				$updateEmailNotification[] = $user->id;
				echo $k." : ".$user->id." ".$user->email."<br>";
            }

			EmailNotification::whereIn( 'id', $updateEmailNotification )->update( ['is_send_notification' => 0] );
			Blogs::where( 'id', $content->id )->update( ['is_send_template' => 1 ] );
			
			dd( $content );
            $user = [];
			$user['id'] = 0;
            $user['customer_name'] = "Test Mail";
            $user['email'] = "cloudwebs17@gmail.com";
            $user = (object)$user;
            Mail::to( $user->email )->send(new InfoEmail( $user, $content ));
        }

		//dd( $updateEmailNotification );
        //return true;
    }

    /**
     * Email blog notification send in every mid night
     */
    public function unSubscribeBlog( $id )
    {   
        $emailArr = EmailNotification::find( _de( $id ) );
        $emailArr->un_subscribe = 1;
        $emailArr->save();

        return view('emails.unsubscribe', compact('emailArr'));
    }

    public function maintananceInstall(){
        for( $i=0;$i<=50;$i++ ){
            $maintanance = new Maintanance();
            $maintanance->user_id = 1;
            $maintanance->wing_id = 1;
            $maintanance->title = generateRandomString();
            $maintanance->short_description = generateRandomString(50);
            $maintanance->amount = rand(11, 9999);
            $maintanance->paid_date = "2023-".rand(6, 9)."-30";
            $maintanance->save();
        }
    }

    public function flatInstall(){
        for( $i=0;$i<=46;$i++ ){
            $home = new Home();
            $home->user_id = 1;
            $home->wing_id = 1;
            $home->name = generateRandomString();
            $home->mobile_number = rand(1111111111, 9999999999);
            $home->status = 1;
            $home->save();
        }
    }

    public function flatMaintananceInstall(){
        for( $i=1;$i<=47;$i++ ){
            if( $i != 19 ){
                for( $j=6; $j<=9;$j++ ){
                    $home = new HomeMaintanance();
                    $home->user_id = 1;
                    $home->wing_id = 1;
                    $home->home_id = $i;
                    $home->amount = 1000;
                    $home->paid_date = "2023-".$j."-30";
                    $home->save();
                }
            }
        }
    }

    /**
     * @Function:        <show>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <21-10-2023>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reportView($id)
    {
        $maintananceReport = MaintananceReport::find($id);
        $receiveMaintanance = HomeMaintanance::with( 'home' )
        ->where([
            'user_id' => auth()->guard('admin')->user()->id,
            'wing_id' => auth()->guard('admin')->user()->wing_id,
        ])
        ->whereBetween( 'paid_date', [ $maintananceReport->start_date, $maintananceReport->end_date ] )
        ->get();

        $paidMaintanance = Maintanance::where([
            'user_id' => auth()->guard('admin')->user()->id,
            'wing_id' => auth()->guard('admin')->user()->wing_id,
        ])
        ->whereBetween( 'paid_date', [ $maintananceReport->start_date, $maintananceReport->end_date ])
        ->get();

        $halfReceiveMaintanance = round( COUNT( $receiveMaintanance ) / 2 );
        $halfPaidMaintanance = round( COUNT( $paidMaintanance ) / 2 );
        return view('admin.maintanance.report_view', compact( 'maintananceReport', 'receiveMaintanance', 'paidMaintanance', 'halfReceiveMaintanance', 'halfPaidMaintanance' ));
    }
}
