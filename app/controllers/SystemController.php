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
        // User::all();
        /*
                need 
                "Contacts API"
                "Google+ API"
        */
        // if ( ($user = User::where('email', '=', 'voluntarin@gmail.com')->first()) ) {
        //     Session::put('user', $user);
        //     return '<script> parent.loginSuccess(); </script>';
        // }

        $client = new Google_Client();
        $client->setClientId( CLIENT_ID );
        $client->setClientSecret( CLIENT_SECRET );
        $client->setRedirectUri( asset( 'oauth2callback' ) );
        if ( Input::get('code') ) {
            $client->authenticate( Input::get('code') );
            $token = json_decode($client->getAccessToken(), TRUE);
            $authURL = 'https://www.googleapis.com/plus/v1/people/me';
            $APIKey = APIKEY;
            $profile = file_get_contents("{$authURL}?key={$APIKey}&alt=json&access_token={$token['access_token']}");
            $profile = json_decode($profile, TRUE);
            $email = $profile['emails'][0]['value'];

            if ( ($user = User::where('email', $email)->first()) ) {
                Session::put('user', $user);
                return '<script> parent.loginSuccess(); </script>';
            }
            return '<script> parent.loginError(); </script>';
        }
	}
}
