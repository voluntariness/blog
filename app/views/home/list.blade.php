@extends('template')
@include('home/sidebar')
@section('content')
    <div id="content" class="col-xs-10">
        <h2><?= $sidebar['menu'][$sidebar['active']]->value ?></h2>
        <hr/>
        <?php foreach ( $list as $row ) : ?>
            <article id="article-<?= $row->id ?>">
                <div class="row article-header">  
                    <div class="col-xs-10 article-title">
                        <h3><a href="/home/view/<?= $row->id ?>"><?= $row->title ?></a></h3>
                    </div>
                    <div class="col-xs-2 article-date"> 
                        <?= date('m 月 d 日 ( Y )',strtotime($row->created_at)) ?>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-xs-12 article-content" >
                        <?= $row->html ?>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
@stop