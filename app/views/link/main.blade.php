@extends('template')
@include('link/sidebar')
@section('content')
    <div id="content" class="col-xs-12">
        <h2><?= $row->title ?></h2>
        <hr/>
        <?= $row->html ?>
    </div>
@stop