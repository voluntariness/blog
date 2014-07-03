@extends('template')
@include('manage/sidebar')
@section('content')
    <div id="content" class="col-xs-10">
        <h4>文章管理 <a href="/manage/article/modify/0" class="new-btn btn btn-primary">New</a> </h4>
        @foreach ( $list as $row )
            <article>

            </article>
        @endforeach
    </div>
@stop