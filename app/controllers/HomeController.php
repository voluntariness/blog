<?php

class HomeController extends BaseController 
{

    public function index( $type = 'all' )
    {

        $query = Article::where('status','public')->orderBy('created_at','desc');


        $list = ( empty($type) || $type == 'all' )
            ? $query->get()
            : $query->where('type', $type)->get();

        foreach ( $list as &$row ) {
            if ( ($idx = mb_strpos($row->html, '@header')) ) {
                $row->html = substr( $row->html, 0, $idx ) . '<p> ...... </p>';
            }
        }

        $this->setData('list', $list );
        return View::make('home/list', $this->getData() );

    }
    public function pageView ( $id = 0 ) 
    {
        $id = is_numeric($id) ? $id : 0;
        if ( ! ($row = Article::find( $id )) ) {
            var_dump($row);
            $row = new Article;
            $row->id = 0;
            $row->html = '無此文章內容！';
        } else if ( $row->status != 'public' ) {
            $row->htlm = '此文章已被限制瀏覽！';
        }
        $row->html = str_replace('@header', '', $row->html);
        $this->setData('row', $row);
        return View::make('home/view', $this->getData());
    }

    function __construct()
    {
        parent::__construct();
        $menu = Article::menu('public');
        $active = Request::segment(3);

        ! in_array($active, array_keys($menu))
            and $active = array_keys($menu)[0];



        $this->setData('sidebar', ['menu'=>$menu, 'active'=>$active]);
    }

}
