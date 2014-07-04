@section('sidebar')
    <div id="sidebar" class="col-xs-2">
        <ul class="list-group">
            <?php foreach ( $sidebar['menu'] as $tag => $name ) : ?>
                <?php $active = $sidebar['active'] == $tag ? 'active' : ''; ?>
                <a class="list-group-item <?= $active ?>" href="/manage/<?=$tag?>">
                    <?=$name?>
                </a>
            <?php endforeach; ?>
        </ul>
    </div>
@stop