@section('sidebar')
    <div id="sidebar" class="col-xs-2">
        <ul class="list-group">
            <?php foreach ( $menu['list'] as $tag => $name ) : ?>
                <?php $active = $menu['active'] == $tag ? 'active' : ''; ?>
                <a class="list-group-item <?= $active ?>" href="/article/index/<?=$tag?>">
                    <span class="badge"><?= isset($counts[$tag]) ? $counts[$tag] : 0 ?></span>
                    <?=$name?>
                </a>
            <?php endforeach; ?>
        </ul>
    </div>
@stop