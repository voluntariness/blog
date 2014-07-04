<?php

class BaseController extends Controller {

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    private $data = [];

    protected function setData( $key, $val = null )
    {
        if (is_array($key)) {
            $this->data += $key;
        } else {
            $this->data[$key] = $val;
        }
    }
    protected function getData()
    {
    	return $this->data;
    }

    function __construct()
    {

    	if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}

        /* menu list */
        $menu['menu'] = [ 
            'home' => 'Home'
            , 'link'    => 'Link'
            , 'about'   => 'About'
        ];

        if ( Session::get('user') ) {

            $this->setData('user', Session::get('user') );

            $menu['menu']['manage']  = '網站管理';
        } else {
            /* 產生登入網址 */
            // require_once app_path() . '/libs/Google/Load.php';
            $client = new Google_Client();
            $client->setClientId( CLIENT_ID );
            $client->setClientSecret( CLIENT_SECRET );
            $client->setRedirectUri( asset( 'oauth2callback' ) );
            $client->addScope( array (
                // Know your basic profile info and list of people in your circles.
                // "https://www.googleapis.com/auth/plus.login",
                // Know who you are on Google
                "https://www.googleapis.com/auth/plus.me",
                // View your email address
                "https://www.googleapis.com/auth/userinfo.email",
                // View basic information about your account
                "https://www.googleapis.com/auth/userinfo.profile"
            ));
            $this->setData('login_url', $client->createAuthUrl());
            // $this->setData('login_url', '/oauth2callback');

        } /* end - if :: user */


        $menu['active'] = str_replace('controller', '', strtolower(get_class($this)));
        $this->setData('header_menu', $menu);

    }

}
