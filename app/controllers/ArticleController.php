<?php

class ArticleController extends BaseController {

    // protected $template = 'template';
    private $menu = [];

    public function index( $type = 'all' )
    {
        $data = [];
        $this->menu['active'] = $type;
        $data['menu'] = $this->menu;

        $data['list'] = [];
        
        return View::make('article/list', $data );

    }

    function __construct()
    {
        parent::__construct();

        $this->menu = [
            'list' => [
                'all' => '所有文章'
                , 'php' => 'PHP'
                , 'js' => 'JavaScript'
                , 'Other' => 'other'
            ]
        ];

    }

}
