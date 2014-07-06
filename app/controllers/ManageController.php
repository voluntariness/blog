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
    public function pageParameterAjax ( $key = null)
    {
        $request = [ 'status' => false , 'msg' => '' ];

        switch ( $key ) {
            case 'groups':
                $request['groups'] = Parameter::where('group', 'GroupType')->get();
                $request['status'] = true;
            break;

        }

        return json_encode( $request );

    }

    function __construct()
    {
        parent::__construct();
        $menu = [
            'menu' => [
                'article' => '文章管理'
                , 'message' => '留言管理'
                , 'users' => '成員管理'
                , 'parameter' => '參數管理'
            ]
            , 'active' => Request::segment(2)
        ];

        $this->setData('sidebar', $menu);
    }


}