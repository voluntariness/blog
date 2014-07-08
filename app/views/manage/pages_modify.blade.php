
@extends('template')
@include('manage/sidebar')
@section('content')
    <div id="content" class="col-xs-10">
        <h2>新增 / 修改 靜態頁管理  </h2>
        <hr/>
        <form id="form-save" action="/manage/pages/save" method="post" class="form-horizontal" role="form">
            <input type="hidden" name="id" value="<?= $row->id ?>" />
            <div class="form-group" >
                <label for="page-title" class="col-xs-1 control-label">標題 Title</label>
                <div class="col-xs-5">
                    <input type="text" id="page-title" class="form-control" name="title" value="<?= $row->title ?>" />
                </div>
                <label for="page-key" class="col-xs-1 control-label">參數 Key</label>
                <div class="col-xs-2">
                    <input type="text" id="page-key" class="form-control" name="key" value="<?= $row->key ?>" />
                </div>
            </div>

            <div class="form-group">
                <label for="page-text" class="col-xs-1 control-label">內容 Content</label>
                <div class="col-xs-8">
                    <div id="epiceditor"></div>
                    <textarea class="hide" id="page-text" name="text"><?= $row->text ?></textarea>
                    <textarea class="hide" id="page-html" name="html"><?= $row->html ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-1 col-xs-offset-1">
                    <button type="submit" class="btn btn-primary save-btn" btn-action="save">
                        <span class="glyphicon glyphicon-floppy-disk" ></span>  Save
                    </button>
                </div>
                <div class="col-xs-1">
                    <button type="button" class="btn btn-default back-btn" >
                        <span class="glyphicon glyphicon-arrow-left" ></span>  Back
                    </button>
                </div>
            </div>
        </form>
    </div>
@stop

@section('script')
    <script type="text/javascript">
        
        epic_opts.textarea = 'page-text';
        epic_opts.autogrow.minHeight = 400;
        var editor = new EpicEditor(epic_opts).load();
        editor.on('update', function ( data ) {
            $('textarea[name=text]').html( data.content );
            $('textarea[name=html]').html( editor.exportFile(null, 'html') );
        });

        $( editor.getElement('editor').body ).on('keydown', function (event) {
            if ( event.keyCode === 9 ) {
                var textNode = document.createTextNode( '\u00A0\u00A0\u00A0\u00A0 ' );
                sel = editor.getElement('editor').getSelection();
                range = sel.getRangeAt(0);
                range.deleteContents();
                range.insertNode( textNode );
                range.setStart(textNode, textNode.length);
                range.setEnd(textNode, textNode.length);
                sel.removeAllRanges();
                sel.addRange(range);
                return false;  
            } 
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