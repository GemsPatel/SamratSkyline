<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{$content->title}}</title>
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

            <table width="100%">
                <tr>
                    <td style="padding: 20px 0; text-align: center;">
                        <p style="margin-top: 5px;">Hi, {{$user->customer_name}}.</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 20px 0; text-align: center;">
                        <h1 style="margin: 0; color: #333;">{{$content->title}}</h1>
                        <p style="margin-top: 5px; color: #777;">Stay up-to-date with the latest from our blog.</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img src="{{url('storage/app/'.$content->image)}}" alt="Best Self-Reflection Journaling Questions" style="width: 100%; max-width: 600px; height: auto;">
                    </td>
                </tr>
                <tr>
                    <td style="padding: 20px 0;">
                        <p>{{$content->short_description}}</p>
                        <p style="margin-top: 20px;">Click
                            <a href="{{url('tiny/'.$content->short_url)}}" style="color: #007bff; text-decoration: none;" title="{{$content->title}}">
                                Here
                            </a>
                            to read our blog
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 20px 0; text-align: center;">
                        <p style="color: #777;">If you no longer wish to receive these notifications, you can unsubscribe
                            <a href="{{url('un-subscribe/'._en( $user->id ) )}}" title="Un-Subscribe" style="color: #007bff; text-decoration: none;"> here</a>.
                        </p>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>