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

        $this->setData('types', Parameter::where('group','ArticleType')->get());
        $this->setData('type_select', $type);

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

    public function pageParameterList ( $group = 'GroupType')
    {

        empty($group) and $group = 'GroupType';

        /* 取得所有參數群組名稱 */
        $this->setData('groups', Parameter::select('key','value')->where('group','GroupType')->get() );

        /* 取得 $group 的群組所有資料 */
        $this->setData('list', Parameter::where('group', $group)->get());

        $this->setData('group_name', ($group=='new') ? 'NewGroup' : $group );

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
        } elseif ( empty(trim($row->key)) ) {
            $invalid['key'] = ' 此欄位不能為空值！ ';
        } elseif ( empty(trim($row->value)) ) {
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