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
        $menu = Article::menu();
        $active = Request::segment(2);

        ! in_array($active, array_keys($menu))
            and $active = array_keys($menu)[0];



        $this->setData('sidebar', ['menu'=>$menu, 'active'=>$active]);
    }

}
