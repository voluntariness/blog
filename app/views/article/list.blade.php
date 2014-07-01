@extends('template');
@include('article/side', ['menu', $menu]);

@section('content')
    <div id="content" class="col-xs-9">
    abcde
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