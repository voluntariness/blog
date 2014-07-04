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
                        @foreach ($groups as $row )
                            <?php $selected = ( $group_name == $row->group ? 'selected' : '' ); ?>
                            <option value="<?= $row->group ?>" <?= $selected ?> ><?= $row->group ?></option>
                        @endforeach
                        <option value="new">新增</option>
                    </select>
                </div>
            </div>
        </form>

        <form action="/manage/parameter/save/group" method="post" class="form-horizontal" role="form">
            <div class="form-group">
                <label for="parameter-group" class="col-xs-1 control-label">群組名稱</label>
                <div class="col-xs-2">
                    <input type="text" id="parameter-group" class="form-control" name="group" value="<?= $group_name ?>" />
                    <input type="hidden" name="original-group" value="<?= $group_name ?>" />
                </div>
            </div>
        </form>

        <hr/>

        <div id="group-data">

            <?php /* 資料列範例 */ ?>
            <div id="template-row" class="hide" >
                <form action="/manage/parameter/save/data" method="post" class="form-horizontal" role="form">
                    <div class="bs-callout bs-callout-default" >
                        <input type="hidden" name="id" value="" />
                        <div class="form-group" >
                            <label for="parameter-group" class="col-xs-1 control-label">參數 Key</label>
                            <div class="col-xs-2">
                                <input type="text" id="parameter-group" class="form-control" name="key" value="" />
                            </div>
                            <label for="parameter-group" class="col-xs-1 control-label">參數 Value </label>
                            <div class="col-xs-2">
                                <input type="text" id="parameter-group" class="form-control" name="value" value="" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="parameter-group" class="col-xs-1 control-label">參數說明</label>
                            <div class="col-xs-5">
                                <input type="text" id="parameter-group" class="form-control" name="caption" value="" />
                            </div>
                        </div>
                    </div>
                </form>
                <hr/>
            </div>

            @foreach ( $list as $row )
                <form action="/manage/parameter/save/data" method="post" class="form-horizontal" role="form">
                    <div class="bs-callout bs-callout-success" >
                        <div class="form-group">
                            <label for="parameter-group" class="col-xs-1 control-label">參數 Key</label>
                            <div class="col-xs-2">
                                <input type="text" id="parameter-group" class="form-control" name="key[]" value="<?= $row->key ?>" />
                            </div>
                            <label for="parameter-group" class="col-xs-1 control-label">參數 Value </label>
                            <div class="col-xs-2">
                                <input type="text" id="parameter-group" class="form-control" name="value[]" value="<?= $row->value ?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="parameter-caption" class="col-xs-1 control-label">參數說明</label>
                            <div class="col-xs-5">
                                <input type="text" id="parameter-caption" class="form-control" name="caption" value="<?= $row->caption ?>" />
                            </div>
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
        $('#select-group').on('change', function (){
            location.href = '/manage/parameter/' + $(this).val();
        });
            
        $('#add-row').on('click', function() {
            $('#group-data').append( $('#template-row').html() );
        });
    </script>
@stop