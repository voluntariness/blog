@extends('template')
@include('home/sidebar')
@section('content')
    <div id="content" class="col-xs-10">
        <div class="row">
            <div class="col-xs-12">
                <h2> <?= $row->title ?> </h2> 
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-xs-12">
                <?= $row->html ?>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-xs-1 col-xs-offset-11">
                <button class="btn btn-default back-btn">Back</button>
            </div>
        </div>
    </div>
@stop