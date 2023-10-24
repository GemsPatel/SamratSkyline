<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\Mail;

class MailGunController extends Controller
{
	public function index()
	{
		$user = (array)Customer::find(1);

		Mail::send('emails.mailEvent', $user, function($message) use ($user) {
			$message->to($user['email']);
			$message->subject('Testing Mailgun');
		});
		dd('Mail Send Successfully');
    }
}