@extends('template')
@include('manage/sidebar')
@section('content')
    <div id="content" class="col-xs-10">
        <h4>文章管理  </h4>
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


    </div>
@stop

@section('script')
    <script type="text/javascript">
        $('#select-type').on('change', function () {
            location.href= $('#form-type').attr('action') + $(this).val();
        });
    </script>
@stop