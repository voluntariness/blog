@extends('template')
@include('manage/sidebar')
@section('content')
    <div id="content" class="col-xs-10">
        <h4>參數管理</h4>
        <hr/>
        <form id="form-group" action="/manage/parameter" method="get" class="form-horizontal" role="form">
            <div class="form-group">
                <label for="select-group" class="col-xs-1 control-label">參數群組</label>
                <div class="col-xs-2">
                    <select id="select-group" class="form-control" name="select-group">
                        <option value="GroupType">各群組管理</option>
                        <?php foreach ($groups as $row ) : ?>
                            <?= Html::options( $groups, $group_select ) ?>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </form>

        <hr/>

        <div id="group-data">

            <?php /* 資料列範例 */ ?>
            <div id="template-row" class="hide" >
                <form action="/manage/parameter" method="post" class="form-horizontal" role="form">
                    <input type="hidden" name="id" value="0" />
                    <input type="hidden" name="group" value="<?=$group_select?>" />
                    <div class="bs-callout bs-callout-default data-status" >
                        <div class="form-group" >
                            <label for="parameter-group" class="col-xs-1 control-label">參數 Key</label>
                            <div class="col-xs-2">
                                <input type="text" id="parameter-group" class="form-control" name="key" value="" />
                            </div>
                            <label for="parameter-group" class="col-xs-1 control-label">參數 Value </label>
                            <div class="col-xs-2">
                                <input type="text" id="parameter-group" class="form-control" name="value" value="" />
                            </div>
                            <label for="parameter-order" class="col-xs-1 control-label">順序 </label>
                            <div class="col-xs-2">
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="parameter-group" class="col-xs-1 control-label">參數說明</label>
                            <div class="col-xs-5">
                                <input type="text" id="parameter-group" class="form-control" name="caption" value="" />
                            </div>
                            <div class="col-xs-1">
                                <button type="submit" class="btn btn-primary save-btn" btn-action="save">
                                    <span class="glyphicon glyphicon-floppy-disk" ></span>  Save
                                </button>
                            </div>
                            <div class="col-xs-1">
                                <button type="button" class="btn btn-default delete-btn" tabindex="-1">
                                    <span class="glyphicon glyphicon-floppy-remove" ></span>  Remove
                                </button>
                            </div>
                            <div class="col-xs-3 request-msg"> </div>
                        </div>
                    </div>
                    <hr/>
                </form>
            </div>

            @foreach ( $list as $row )
                <form action="/manage/parameter" method="post" class="form-horizontal" role="form">
                    <input type="hidden" name="id" value="<?=$row->id?>" />
                    <input type="hidden" name="group" value="<?=$group_select?>" />
                    <div class="bs-callout bs-callout-success data-status" >
                        <div class="form-group">
                            <label for="parameter-group" class="col-xs-1 control-label">參數 Key</label>
                            <div class="col-xs-2">
                                <input type="text" id="parameter-group" class="form-control" name="key" value="<?= $row->key ?>" />
                            </div>
                            <label for="parameter-group" class="col-xs-1 control-label">參數 Value </label>
                            <div class="col-xs-2">
                                <input type="text" id="parameter-group" class="form-control" name="value" value="<?= $row->value ?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="parameter-caption" class="col-xs-1 control-label">參數說明</label>
                            <div class="col-xs-5">
                                <input type="text" id="parameter-caption" class="form-control" name="caption" value="<?= $row->caption ?>" />
                            </div>
                            <div class="col-xs-1">
                                <button type="submit" class="btn btn-primary save-btn" btn-action="save">
                                    <span class="glyphicon glyphicon-floppy-disk" ></span>  Save
                                </button>
                            </div>
                            <div class="col-xs-1">
                                <button type="button" class="btn btn-default delete-btn" tabindex="-1">
                                    <span class="glyphicon glyphicon-floppy-remove" ></span>  Remove
                                </button>
                            </div>
                            <div class="col-xs-3 request-msg"> </div>
                        </div>

                    </div>
                </form>
            @endforeach
        </div>
        <button id="add-row" type="button" class="btn btn-default">
            <span class="glyphicon glyphicon-plus" ></span>  新增參數
        </button>
    </div>
@stop


@section('script')
    <script type="text/javascript">

        var dataStatus = function ( formDom, status, msg )
        {
            $(formDom).find('.data-status')
                .attr('class', 'data-status bs-callout bs-callout-' + status);
            (new Message).msg(status, msg, 3000).show( $(formDom).find('.request-msg') );
        }

        /* 更新 參數群組 */
        var updateGroup = function ( )
        {
            var url = '/manage/parameter/ajax/groups';
            $.ajax( url, { dataType: 'json' } )
                .done( function ( request ) {
                    if ( request.status ) {
                        var selGroup = $('#select-group'), groups = request.groups;
                        selGroup.html('');
                        $('<option/>').val('GroupType').html('各群組管理').appendTo(selGroup);
                        for ( var i in groups ) {
                            $('<option/>').val( groups[i]['key'] )
                                .html( groups[i]['value'] )
                                .appendTo( selGroup );
                        }
                    }
                })
                .fail( function ( request ) {});
        }

        $('#select-group').on('change', function (){
            location.href = '/manage/parameter/view/' + $(this).val();
        });
            
        $('#add-row').on('click', function() {
            var dom = $('#template-row').html();
            $(dom).appendTo( $('#group-data') )
                .find('input[type=text]:first')
                .focus();

        });


        $('#group-data').on('change', 'input', function () {
            var dom = $(this).parents('.data-status');
            dom.attr('class', 'bs-callout bs-callout-warning data-status');
        });

        $('#group-data').on('submit', 'form', function ( event ) {

            var data = $(this).serialize()
                , url = $(this).attr('action') + '/save'
                , formDom = $(this);

            $.ajax( url, {data: data, type: 'post', dataType: 'json', ajaxLock: true } )
                .done( function (request) {

                    if ( request.status ) {
                        formDom.find('input[name=id]').val( request.id );

                        if( $('#select-group').val() == 'GroupType' ) {
                            updateGroup();
                        }

                    } else {
                        for ( var name in request.invalid ) {
                            formDom.find('[name=' + name + ']')
                                .addClass('invalid')
                                .attr('title', request.invalid[name]);
                        }
                    }
                    var status = ( request.status ? 'success' : 'warning' );
                    dataStatus( formDom, status, request.msg );

                })
                .fail( function (request) {
                    dataStatus( formDom, 'danger', '伺服器錯誤！' );
                });

            return false;
        });

        $('#group-data').on('click', '.delete-btn', function ( event ) {

            if( ! confirm('確定刪除此資料？') ) {
                return ;
            }

            var formDom = $(this).parents('form')
                , data = formDom.serialize()
                , url = formDom.attr('action') + '/delete';

            if ( formDom.find('input[name=id]').val() == 0 ) {
                removeDom( formDom );
                return;
            }

            $.ajax( url, {data: data, type: 'post', dataType: 'json', ajaxLock: true } )
                .done( function (request) {
                    if ( request.status ) {

                        if( $('#select-group').val() == 'GroupType' ) {
                            updateGroup();
                        }

                        removeDom( formDom );

                        showMsg( (new Message()).success( request.msg, 3000) );
                    } else {
                        dataStatus( formDom, 'danger', request.msg );
                    }

                })
                .fail( function (request) {
                    dataStatus( formDom, 'danger', '伺服器錯誤！' );
                });

        });

    </script>
@stop