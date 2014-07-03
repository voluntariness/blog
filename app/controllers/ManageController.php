<?php

class ManageController extends BaseController 
{
    public function index ( $page = 'article', $type = null ) 
    {
        $this->setData('sidebar_active', $page);
        switch ( $page ) {
            case 'article'  : return $this->pageArticleList();        
            case 'message'  : return $this->pageMessageList();
            case 'users'   : return $this->pageUsersList();
            default         : 

                break;
        }
    }

    /*
        public function pageNewsList ( $type = null )
        {
            return View::make('manage/news', $this->getData());
        }
    */

    public function pageArticleList ()
    {
        return View::make('manage/article', $this->getData() );
    }
    public function pageMessageList ( $type = null )
    {
        return View::make('manage/message', $this->getData());
    }
    public function pageUsersList ( $type = null )
    {
        return View::make('manage/users', $this->getData());
    }


    function __construct()
    {
        parent::__construct();

        $menu = [
            // 'news' => '訊息管理'
            'article' => '文章管理'
            , 'message' => '留言管理'
            , 'users' => '成員管理'
        ];

        $this->setData('side_menu', $menu);
    }


}