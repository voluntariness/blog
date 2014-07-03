@extends('template')
@include('manage/sidebar')
@section('content')
    <div id="content" class="col-xs-10">
        <form action="/manage/save/<?=$row->id?>" method="post" class="form-horizontal" role="form">
            <div class="form-group">
                <label for="article-title" class="col-xs-1 control-label">Title</label>
                <div class="col-xs-6">
                    <input type="email" class="form-control" id="article-title" name="title" placeholder="Title">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-xs-1 control-label">type</label>
                <div class="col-xs-10">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-offset-1 col-xs-10">
                    <button type="submit" class="btn btn-default">Save</button>
                    <button type="submit" class="btn btn-default">Back</button>
                </div>
            </div>
        </form>
    </div>
@stop