<?php

class ManageController extends BaseController 
{

    /*
        public function pageNewsList ( $type = null )
        {
            return View::make('manage/news', $this->getData());
        }
    */

    public function pageArticleList ( $type = null)
    {
        // $this->setData('sidebar')
        // $query = DB::table('article')->orderBy('article_date','desc');
        // ( ! empty( $type ) ) and $query->where('article_type', $type );
        $list = empty( $type ) 
            ? Article::orderBy('datetime','desc')->get() 
            : Article::where('type', $type)->orderBy('datetime', 'desc')->get(); 
        $this->setData('list', $list );

        return View::make('manage/article', $this->getData() );
    }

    public function pageArticleModify( $id = 0 )
    {
        $id = is_numeric($id) ? $id : 0;

        ( $row = Article::find($id) ) or ( $row = new Article );

        $this->setData( 'row', $row );
        
        return View::make('manage/article_modify', $this->getData() );
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
            'menu' => [
                'article' => '文章管理'
                , 'message' => '留言管理'
                , 'users' => '成員管理'
            ]
            , 'active' => Request::segment(2)
        ];

        $this->setData('sidebar', $menu);
    }


}