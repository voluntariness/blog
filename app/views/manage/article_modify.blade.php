@extends('template')
@include('manage/sidebar')
@section('content')
    <div id="content" class="col-xs-10">
        <form id="form-save" action="/manage/article/save" method="post" class="form-horizontal" role="form">
            <input type="hidden" name="id" value="<?= $row->id ?>" />
            <div class="form-group">
                <label for="article-title" class="col-xs-1 control-label">Title</label>
                <div class="col-xs-5">
                    <input type="test" class="form-control" id="article-title" name="title" value="<?=$row->title?>" placeholder="Title">
                </div>
            </div>
            <div class="form-group">
                <label for="article-tag" class="col-xs-1 control-label">Tag</label>
                <div class="col-xs-5">
                    <input type="text" id="article-tag" class="form-control" name="tag" value="<?=$row->tag?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="article-type" class="col-xs-1 control-label">類型</label>
                <div class="col-xs-2 ">
                    <select id="article-type" class="form-control" name="type" >
                            <?= Html::options( $type_list, $row->type ); ?>
                    </select>
                </div>
                <label for="article-status" class="col-xs-1 control-label">狀態</label>
                <div class="col-xs-2">
                    <select id="article-status" class="form-control" name="status" >
                            <?= Html::options( $status_list, $row->status ); ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="epiceditor" class="col-xs-1 control-label">文章</label>
                <div class="col-xs-8">
                    <div id="epiceditor"></div>
                    <textarea class="hide" id="article-text" name="text"><?= $row->text ?></textarea>
                    <textarea class="hide" id="article-html" name="html"><?= $row->html ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-offset-1 col-xs-10">
                    <button type="submit" class="btn btn-primary save-btn" btn-action="save">
                        <span class="glyphicon glyphicon-floppy-disk" ></span>  Save
                    </button>
                    <button type="button" class="btn btn-default back-btn" >
                        <span class="glyphicon glyphicon-arrow-left" ></span>  Back
                    </button>
                </div>
                </div>
            </div>
        </form>
    </div>
@stop

@section('script')
    <script type="text/javascript">
        epic_opts.textarea = 'article-text';
        epic_opts.autogrow.minHeight = 400;
        var editor = new EpicEditor(epic_opts).load();
        // editor.importFile( null, $('textarea[name=text]').html() );
        editor.on('update', function ( data ) {
            $('textarea[name=text]').html( data.content );
            $('textarea[name=html]').html( editor.exportFile(null, 'html') );
        });

        $('#form-save').on('submit', function () {

            var url = $(this).attr('action')
                , data = $(this).serialize();

            $('.invalid').removeAttr('title').removeClass('invalid');
            
            $.ajax( url, {data: data, type: 'post', dataType: 'json', ajaxLock: true} )
                .done( function ( request ) {
                    if ( request.status ) {
                        (new Alert).redirect( request.url ).success( request.msg );
                    } else {
                        var invalid = request.invalid;
                        for ( var name in invalid ) {
                            $('[name=' + name + ']').addClass('invalid')
                                .attr('title', invalid[name]);
                        }
                    };
                })
                .fail( function ( request ) {

                });


            return false;
        });

    </script>
@stop