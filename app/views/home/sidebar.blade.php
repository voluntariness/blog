@section('sidebar')
    <div id="sidebar" class="col-xs-2">
        <ul class="list-group">
            <?php foreach ( $sidebar['menu'] as $tag => $row ) : ?>
                <?php $active = $sidebar['active'] == $tag ? 'active' : ''; ?>
                <a class="list-group-item <?= $active ?>" href="/home/<?=$tag?>">
                    <span class="badge"><?= $row->count ?></span>
                    <?= $row->value ?>
                </a>
            <?php endforeach; ?>
        </ul>
    </div>
@stop