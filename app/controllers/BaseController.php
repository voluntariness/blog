<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected $data = [];

	protected function data( $name, $value )
	{
		if (is_array($name)) {
			
		}
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


		$data = [];

        /* menu list */
        $list = [ 'about'   => 'About'
            	, 'article' => '文章'
        ];

        if ( ($data['user'] = $this->getUser()) ) {
            $list['manage_article']  = '文章管理';
            $list['manage_message']  = '留言管理';
        }
        $data['active'] = str_replace('controller', '', strtolower(get_class($this)));
        $data['menu_list'] = $list;

        View::make('template', $data);

    }

}
