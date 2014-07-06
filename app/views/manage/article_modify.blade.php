@extends('template')
@include('manage/sidebar')
@section('content')
    <div id="content" class="col-xs-10">
        <form id="form-save" action="/manage/save/<?=$row->id?>" method="post" class="form-horizontal" role="form">
            <div class="form-group">
                <label for="article-title" class="col-xs-1 control-label">Title</label>
                <div class="col-xs-8">
                    <input type="email" class="form-control" id="article-title" name="title" placeholder="Title">
                </div>
            </div>
            <div class="form-group">
                <label for="article-tag" class="col-xs-1 control-label">Tag</label>
                <div class="col-xs-5">
                    <input type="text" class="form-control" name="tag" value="" />
                </div>
            </div>
            <div class="form-group">
                <label for="article-type" class="col-xs-1 control-label">類型</label>
                <div class="col-xs-2 ">
                    <select id="article-type" class="form-control" name="type" >
                            <?= Html::options( $type_list ); ?>
                    </select>
                </div>
                <label for="article-tag" class="col-xs-1 control-label">狀態</label>
                <div class="col-xs-2">
                    <select id="article-type" class="form-control" name="type" >
                            <?= Html::options( $status_list ); ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="epiceditor" class="col-xs-1 control-label">文章</label>
                <div class="col-xs-8">
                    <div id="epiceditor"></div>
                    <textarea class="hide" id="article-text" name="text"></textarea>
                    <textarea class="hide" id="article-html" name="html"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-offset-1 col-xs-10">
                    <button type="submit" class="btn btn-default">Save</button>
                    <button type="button" class="btn btn-default back-btn">Back</button>
                </div>
            </div>
        </form>
    </div>
@stop

@section('script')
    <script type="text/javascript">
        epic_opts.textarea = 'article-text';
        var editor = new EpicEditor(epic_opts).load();
        // editor.importFile( null, $('textarea[name=text]').html() );
        editor.on('update', function ( data ) {
            $('textarea[name=text]').html( data.content );
            $('textarea[name=html]').html( editor.exportFile(null, 'html') );
        });

        $('#form-save').on('submit', function () {

            var url = $(this).attr('action')
                , data = $(this).serialize();

            $('.invalid').removeClass('invalid');
            
            $.ajax( url, {data: data, type: 'post', dataType: 'json', ajaxLock: true} )
                .done( function ( request ) {
                    if ( request.status ) {

                    } else {

                    };
                })
                .fail( function ( request ) {

                });


            return false;
        });

    </script>
@stop