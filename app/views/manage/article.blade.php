@extends('template')
@include('manage/sidebar')
@section('content')
    <div id="content" class="col-xs-10">
        <h2>文章管理  </h2>
        <hr/>
        <form id="form-type" action="/manage/article/type/" method="get" class="form-horizontal" role="form">
            <div class="form-group">
                <label for="select-group" class="col-xs-1 control-label">文章分類</label>
                <div class="col-xs-2">
                    <select id="select-type" class="form-control" >
                        <?= Html::options( $type_list, $type_select) ?>
                    </select>
                </div>
                <div class="col-xs-1">
                    <a href="/manage/article/modify/0" class="new-btn btn btn-primary">New</a>
                </div>
            </div>
        </form>
        <?php foreach ( $list as $row ) : ?>
            <article id="article-<?= $row->id ?>">
                <div class="row article-header">  
                    <div class="col-xs-10 article-title">
                        <h2><?= $row->title ?></h2>
                    </div>
                    <div class="col-xs-2 article-date"> 
                        <?= date('m 月 d 日 ( Y )',strtotime($row->created_at)) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 article-content" >
                        <?= $row->html ?>
                    </div>
                </div>
                <div class="row article-options">
                    <div class="col-xs-9 request-message"></div>
                    <div class="col-xs-3" >
                        <form class="form-delete" action="/manage/article/delete" method="post" parent-dom="#article-<?= $row->id ?>">
                            <a class="btn btn-primary" href="/manage/article/modify/<?=$row->id?>" >
                                <span class="glyphicon glyphicon-pencil"></span> Edit
                            </a>
                            <input type="hidden" name="id" value="<?= $row->id ?>" />
                            <button type="submit" class="btn btn-default">
                                <span class="glyphicon glyphicon-remove"></span> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
@stop

@section('script')
    <script type="text/javascript">
        function updateMenuSelect () 
        {
            var dom = $('#select-type')
                , sel_value = dom.val();
            $.ajax( '/manage/ajax/article-type', {dataType: 'json'} )
                .done( function ( request ) {
                    if ( request.status ) {
                        dom.html('');
                        var list = request.list;
                        for ( var value in list ) {
                            $('<option>').val( value ).html( list[value] ).appendTo( dom );
                        }
                        dom.val( sel_value );
                    }
                });
        }

        $('#select-type').on('change', function () {
            location.href = $('#form-type').attr('action') + $(this).val();
        });


        $('.form-delete').on('submit', function () {

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
                    // (new Message).danger( '伺服器錯誤！', 3000).show( $(dom).find('.request-message') );
                });
            return false;

        });

    </script>
@stop