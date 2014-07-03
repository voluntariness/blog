<?php

class HomeController extends BaseController 
{

    public function index( $type = 'all' )
    {
        $this->setData('sidebar_active', $type);
        $this->setData('list', [] );
        return View::make('home/list', $this->getData() );

    }

    function __construct()
    {
        parent::__construct();
        $menu = [
            'all' => '所有文章'
            , 'php' => 'PHP'
            , 'js' => 'JavaScript'
            , 'Other' => 'other'
        ];

        $this->setData('side_menu', $menu);
    }

}
