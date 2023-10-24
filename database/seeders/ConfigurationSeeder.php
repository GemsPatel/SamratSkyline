<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configurations')->delete();

        DB::table('configurations')->insert([
            ['id' => 1, 'config_key' => 'EMAIL_ADDRESS', 'config_value'=> 'postmaster@mailinator.com', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'config_key' => 'CONTACT_INFO', 'config_value'=> '+234 9955585852', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'config_key' => 'LINKEDIN_SECRET', 'config_value'=> '3P3ax4Qz7p2VIDjR', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 4, 'config_key' => 'LINKEDIN_ID', 'config_value'=> '77j3jl47y1t843', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 5, 'config_key' => 'LINKEDIN_REDIRECT_URL', 'config_value'=> 'http://easysol.com', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 6, 'config_key' => 'AWS_ACCESS_KEY_ID', 'config_value'=> 'AKIAUQGMJNFSPRIECTN7', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 7, 'config_key' => 'AWS_SECRET_ACCESS_KEY', 'config_value'=> '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', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 8, 'config_key' => 'AWS_DEFAULT_REGION', 'config_value'=> 'us-east-2', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 9, 'config_key' => 'AWS_BUCKET', 'config_value'=> 'gentimedia', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 10, 'config_key' => 'AWS_USE_PATH_STYLE_ENDPOINT', 'config_value'=> 'false', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 11, 'config_key' => 'AWS_URL', 'config_value'=> 'gentimedia.s3.us-east-2.amazonaws.com', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 12, 'config_key' => 'AWS_ENDPOINT', 'config_value'=> 'https://s3.us-east-2.amazonaws.com', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 13, 'config_key' => 'TWILIO_SID', 'config_value'=> 'ACb8618830e00697f2a7ae5c7dab9606f5', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 14, 'config_key' => 'TWILIO_AUTH_TOKEN', 'config_value'=> '2f2eaa4d92335da1e9cd0d5897085d80', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 15, 'config_key' => 'TWILIO_NUMBER', 'config_value'=> '+99', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 16, 'config_key' => 'FACEBOOK_CLIENT_ID', 'config_value'=> 'XXX', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 17, 'config_key' => 'FACEBOOK_CLIENT_SECRET', 'config_value'=> 'XXX', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 18, 'config_key' => 'FACEBOOK_CALLBACK_URL', 'config_value'=> 'XXX', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 19, 'config_key' => 'GOOGLE_CLIENT_ID', 'config_value'=> 'XXX', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 20, 'config_key' => 'GOOGLE_CLIENT_SECRET', 'config_value'=> 'XXX', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 21, 'config_key' => 'GOOGLE_CALLBACK_URL', 'config_value'=> 'XXX', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 22, 'config_key' => 'TOP_LISTING_TITLE_LIMIT', 'config_value'=> '15', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 23, 'config_key' => 'TOP_TRENDING_TITLE_LIMIT', 'config_value'=> '15', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 24, 'config_key' => 'PER_PAGINATION', 'config_value'=> '5', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 25, 'config_key' => 'COMMENT_ALLOW_CHARACTER', 'config_value'=> '2000', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 26, 'config_key' => 'PAYSTACK_MODE', 'config_value'=> '0', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 27, 'config_key' => 'PAYSTACK_LIVE_KEY', 'config_value'=> 'sk_live_3b6987e3640ac3cf5e59bee7f3ffc69c47057627', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 28, 'config_key' => 'PAYSTACK_TEST_KEY', 'config_value'=> 'pk_live_ff00619e378030626f161ac23b019c5685b429e2', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}