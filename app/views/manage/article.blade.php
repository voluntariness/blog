@extends('template')
@include('manage/sidebar')
@section('content')
    <div id="content" class="col-xs-10">
        <h4>文章管理  </h4>
        <hr/>
        <form id="form-group" action="/manage/parameter" method="get" class="form-horizontal" role="form">
            <div class="form-group">
                <label for="select-group" class="col-xs-1 control-label">文章分類</label>
                <div class="col-xs-2">
                    <select id="select-group" class="form-control" name="select-group">
                        <option value="">所有文章</option>
                        @foreach ($types as $row )
                            <?php $selected = ( $type_select == $row->key ? 'selected' : '' ); ?>
                            <option value="<?= $row->key ?>" <?= $selected ?> ><?= $row->value ?></option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-1">
                    <a href="/manage/article/modify/0" class="new-btn btn btn-primary">New</a>
                </div>
            </div>
        </form>


    </div>
@stop