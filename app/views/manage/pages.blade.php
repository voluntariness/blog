@extends('template')
@include('manage/sidebar')
@section('content')
    <div id="content" class="col-xs-10">
        <h2>靜態頁管理  </h2>
        <hr/>
        <a class="btn btn-default" href="/manage/pages/modify/0">
            <span class="glyphicon glyphicon-plus" ></span>  新增頁面
        </a>
        <?php foreach ( $list as $row ) : ?>
            <div id="page-<?= $row->id ?>" class="row pages-row bs-callout bs-callout-default">
                <div class="col-xs-5">
                    <?= $row->title ?>
                </div>
                <div class="col-xs-2">
                    <?= $row->key ?>
                </div>
                <div class="col-xs-3">
                    <form class="form-delete" action="/manage/pages/delete" method="post" parent-dom="#page-<?= $row->id ?>">
                        <a class="btn btn-primary" href="/manage/pages/modify/<?=$row->id?>" >
                            <span class="glyphicon glyphicon-pencil"></span> Edit
                        </a>
                        <input type="hidden" name="id" value="<?= $row->id ?>" />
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-remove"></span> Delete
                        </button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
@stop

@section('script')
    <script type="text/javascript">

        $('.form-delete').on('submit', function () {

            if ( ! confirm('是否刪除此資料？') ) {
                return false;
            }

            var data = $(this).serialize()
                , url = $(this).attr('action')
                , dom = $(this).attr('parent-dom');

            $.ajax( url, { data: data, type: 'post', dataType: 'json', ajaxLock: true } )
                .done( function ( request ) {
                    if ( request.status ) {
                        removeDom( dom );
                        (new Alert).success( request.msg );
                        updateMenuSelect();
                    }
                    else
                    {
                        (new Message).danger( msg, 3000).show( $(dom).find('.request-message') );
                    }

                })
                .fail( function ( request ) {
                        (new Alert).danger( '伺服器錯誤！' );
                });
            return false;

        });

    </script>
@stop   