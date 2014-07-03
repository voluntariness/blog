@extends('template')
@include('home/sidebar')
@section('content')
    <div id="content" class="col-xs-10">
            <?php foreach( $list as $row ) : ?>
                <article>
                    <label class="date-label"><?=$row['article_date']?></label>
                    <h3 ><?=$row['article_title']?></h3>
                    <hr/>
                    <?=$row['article_html']?>
                </article>
            <?php endforeach; ?>
    </div>
@stop