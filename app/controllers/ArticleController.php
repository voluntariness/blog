<?php

class ArticleController extends BaseController 
{

    // protected $template = 'template';

    public function index( $type = 'all' )
    {
        $this->setData('side_active', $type);
        $this->setData('list', [] );
        return View::make('article/list', $this->getData() );

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
