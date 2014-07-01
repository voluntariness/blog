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

	public function getUser() 
	{
        return false;
	}
    function __construct()
    {

    	if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}

        /* menu list */
        $menu['menu'] = [ 
        	'about'   => 'About'
            , 'article' => '文章'
        ];

        if ( $this->getUser() ) {
        	$this->setData('user', $this->getUser() );
            $menu['manage_article']  = '文章管理';
            $menu['manage_message']  = '留言管理';
        }
        $menu['active'] = str_replace('controller', '', strtolower(get_class($this)));
        
        $this->setData('header_menu', $menu);

    }

}
