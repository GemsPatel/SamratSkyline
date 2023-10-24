<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Unsubscribe</title>
</head>
    <body style="font-family: math; background-color: #f4f4f4; padding: 20px; margin: 0;">
        <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
            <?php
            $getThemeName = getConfigurationfield("FRONT_THEME");
            ?>
            <div style="width: 100%; text-align: center">
                <a href="{{url('/')}}" class="logo-holder" title="{{pgTitle( $getThemeName )}}">
                    <img class="" src="{{url('public/img/'.$getThemeName.'.png')}}" alt="{{pgTitle( $getThemeName )}}" style="width: 25%;">
                </a>
            </div>

            <p style="margin-top: 5px;">Hello <b>{{ $emailArr->customer_name }}</b>,</p>

            <p style="margin-top: 5px;">We're sorry to see you go. You have been unsubscribed from our email notifications.</p>

            <p style="margin-top: 5px;">If you wish to re-subscribe at any time, you can visit our website and update your email preferences.</p>

            <p style="margin-top: 5px;">Thank you for being a part of our community!</p>

            <p style="margin-top: 5px;">Best regards,<br>
            The <b>{{ config('app.name') }}</b> Team</p>
            
        </div>
    </body>
</html>