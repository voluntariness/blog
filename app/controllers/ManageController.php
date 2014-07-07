<?php

class ManageController extends BaseController 
{

    /*
        public function pageNewsList ( $type = null )
        {
            return View::make('manage/news', $this->getData());
        }
    */

    public function pageArticleList ( $type = null )
    {
        $type_list = Article::menu();
        foreach ( $type_list as $key => $row ) {
            $type_list[$key] = "{$row->value} ( {$row->count} )";
        }
        $this->setData('type_list', $type_list );
        $this->setData('type_select', $type);

        Article::orderBy('created_at','desc')->get();
        if ( ! empty($type) && $type != 'all' ) {
            Article::where('type', $type);
        }        
        $this->setData('list', Article::get() );

        return View::make('manage/article', $this->getData() );
    }

    public function pageArticleModify( $id = 0 )
    {

        $this->setData('type_list', Parameter::options('ArticleType') );

        $this->setData('status_list', Article::status() );

        $id = is_numeric($id) ? $id : 0;

        if ( ! ($row = Article::find($id)) ) {
            $row = new Article;
            $row->id = 0;
        }

        $this->setData( 'row', $row );
        
        return View::make('manage/article_modify', $this->getData() );
    }

    public function pageArticleSave ( $id = 0 ) 
    {
        $invalid = [];
        ( $id = intval(Input::get('id')) ) <= 0 and $id = 0;
        ! ( $row = Article::find($id) ) and $row = new Article;

        $row->title     = Input::get('title');
        $row->tag       = Input::get('tag');
        $row->type      = Input::get('type');
        $row->status    = Input::get('status');
        $row->text      = Input::get('text');
        $row->html      = Input::get('html');

        if ( empty( trim($row->title) ) ) {
            $invalid['title'] = '請填入資料';
        }

        if ( ! in_array($row->type, array_keys(Parameter::options('ArticleType'))) ) {
            $invalid['type'] = '資料錯誤！';
        }

        if ( ! in_array($row->status, array_keys(Article::status())) ) {
            $invalid['type'] = '資料錯誤！';
        }

        if ( count($invalid) > 0 ) {
            return json_encode( ['status' => false, 'invalid' => $invalid, 'msg' => '資料錯誤！'] );
        }

        $row->save();

        return json_encode( ['status' => true, 'msg' => '儲存成功！', 'url' => '/manage/article' ] );

    }

    public function pageArticleDelete () 
    {
        ( $id = intval(Input::get('id')) ) <= 0 and $id = 0;
        if ( ! ($row = Article::find($id)) ) {
            return json_encode( ['status' => false, 'msg' => '查無此資料！'] );
        }
        $row->delete();
        return json_encode( ['status' => true, 'msg' => '資料已刪除！'] );
    }

    public function pageMessageList ( $type = null )
    {
        return View::make('manage/message', $this->getData());
    }

    public function pagePagesList ()
    {
        $this->setData('list', Page::get() );
        return View::make('manage/pages', $this->getData());
    }

    public function pagePagesModify ( $id = 0)
    {
        $id = is_numeric($id) ? $id : 0;
        if ( ! ($row = Page::find($id)) ) {
            $row = new Page;
            $row->id = 0;
        }
        $this->setData( 'row', $row );
        
        return View::make('manage/pages_modify', $this->getData() );
    }

    public function pagePagesSave ( ) 
    {
        $invalid = [];
        ( $id = intval(Input::get('id')) ) <= 0 and $id = 0;
        ! ( $row = Page::find($id) ) and $row = new Page;

        $row->title     = Input::get('title');
        $row->key       = Input::get('key');
        $row->text      = Input::get('text');
        $row->html      = Input::get('html');

        if ( empty( trim($row->title) ) ) {
            $invalid['title'] = '請填入資料';
        }
        if ( empty( trim($row->key) ) ) {
            $invalid['key'] = '請填入資料';
        }

        if ( count($invalid) > 0 ) {
            return json_encode( ['status' => false, 'invalid' => $invalid, 'msg' => '資料錯誤！'] );
        }

        $row->save();

        return json_encode( ['status' => true, 'msg' => '儲存成功！', 'url' => '/manage/pages' ] );

    }

    public function pagePagesDelete () 
    {
        ( $id = intval(Input::get('id')) ) <= 0 and $id = 0;
        if ( ! ($row = Page::find($id)) ) {
            return json_encode( ['status' => false, 'msg' => '查無此資料！'] );
        }
        $row->delete();
        return json_encode( ['status' => true, 'msg' => '資料已刪除！'] );
    }

    public function pageUsersList ( $type = null )
    {
        return View::make('manage/users', $this->getData());
    }

    public function pageParameterList ( $group = 'GroupType')
    {

        empty($group) and $group = 'GroupType';
        /* 取得所有參數群組名稱 */
        $this->setData('groups', Parameter::options('GroupType') );
        $this->setData('group_select', $group );

        /* 取得 $group 的群組所有資料 */
        $this->setData('list', Parameter::where('group', $group)->get());


        return View::make('manage/parameter', $this->getData());
    }

    public function pageParameterSave () 
    {
        $invalid = [];
        ( $id = intval(Input::get('id')) ) <= 0 and $id = 0;
        ! ( $row = Parameter::find($id) ) and $row = new Parameter;

        $row->group     = Input::get('group');
        $row->key       = Input::get('key');
        $row->value     = Input::get('value');
        $row->caption   = Input::get('caption');

        if ( empty(trim($row->group)) ) {
            $invalid['group'] = ' 此欄位不能為空值！ ';
        } 

        if ( empty(trim($row->key)) ) {
            $invalid['key'] = ' 此欄位不能為空值！ ';
        } 

        if ( empty(trim($row->value)) ) {
            $invalid['value'] = ' 此欄位不能為空值！ ';
        }

        if ( count( $invalid ) > 0 ) {
            return json_encode( ['status' => false, 'invalid' => $invalid, 'msg' => '資料錯誤！'] );
        }

        $row->save();

        return json_encode( ['status' => true, 'id' => $row->id, 'msg' => '儲存成功！'] );

    }

    public function pageParameterDelete () 
    {
        ( $id = intval(Input::get('id')) ) <= 0 and $id = 0;
        if ( ! ($row = Parameter::find($id)) ) {
            return json_encode( ['status' => false, 'msg' => '查無此資料！'] );
        }
        $row->delete();
        return json_encode( ['status' => true, 'msg' => '資料已刪除！'] );
    }

    public function callAjax ( $key = null)
    {
        $request = [ 'status' => false , 'msg' => '' ];

        switch ( $key ) {
            case 'groups':
                $request['groups'] = Parameter::where('group', 'GroupType')->get();
                $request['status'] = true;
            case 'article-type':
                $type_list = Article::menu();
                foreach ( $type_list as $key => $row ) {
                    $type_list[$key] = "{$row->value} ( {$row->count} )";
                }
                $request['list'] = $type_list;
                $request['status'] = true;
            break;
        }

        return json_encode( $request );

    }

    function __construct()
    {
        parent::__construct();
        $menu =  [
            'article'       => '文章管理'
            , 'message'     => '留言管理'
            , 'pages'        => '靜態頁管理'
            , 'users'       => '成員管理'
            , 'parameter'   => '參數管理'
        ];

        $active = Request::segment(2);

        ! in_array($active, array_keys($menu))
            and $active = array_keys($menu)[0];

        $this->setData('sidebar', ['menu'=>$menu, 'active'=>$active]);
    }


}