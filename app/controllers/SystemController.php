<?php



class SystemController extends BaseController 
{

    public function logout()
    {
        Session::flush();
        Session::save();
        header( 'location:/' );
        exit;
    }
	public function login()
	{
        /*
                need 
                "Contacts API"
                "Google+ API"
        */
        require_once app_path() . '/libs/Google/Load.php';
        $client = new Google_Client();
        $client->setClientId( CLIENT_ID );
        $client->setClientSecret( CLIENT_SECRET );
        echo asset( 'oauth2callback' );
        exit;
        $client->setRedirectUri( asset( 'oauth2callback' ) );
        if ( Input::get('code') ) {
            $client->authenticate( Input::get('code') );
            $token = json_decode($client->getAccessToken(), TRUE);
            $authURL = 'https://www.googleapis.com/plus/v1/people/me';
            $APIKey = APIKEY;
            $profile = file_get_contents("{$authURL}?key={$APIKey}&alt=json&access_token={$token['access_token']}");
            $profile = json_decode($profile, TRUE);
            $email = $profile['emails'][0]['value'];

            if ( ($user = DB::table('users')->where('users_email', $email)->first()) ) {

                Session::put('user', $user);
                return '<script> parent.login_success(); </script>';
            }
            return '<script> parent.login_error(); </script>';
        }
	}
}
