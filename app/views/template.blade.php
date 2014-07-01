<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hello</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/css/layout.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="/js/layouot.js"></script>
    <script type="text/javascript" src="/js/message.js"></script>
</head>
<body>
    @section('header')
        <header>
            <div id="login-panel" >
                <?php if( isset($login) && $login === true ) : ?>
                    <a href="/ajax/logout" class="btn btn-warning" > 登出 </a>
                <?php else : ?>
                        <input type="password" name="my-password" class="form-control" placeholder=" Password." />
                        <button type="submit" id="login-button" class="btn btn-info" > 登入 </button>
                <?php endif; ?>
            </div>
            <ul class="nav nav-pills">
                <?php foreach( $menu_list as $tag => $name ) : ?>
                    <li class="<?= ($active==$tag ? 'active' : '') ?>">
                        <a href="/<?= $tag ?>"><?= $name ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div id="alert-message"> &nbsp; </div>
        </header>
    @show
    
    <div id="main" class="row well">

        @yield('sidebar')

        @yield('content')

    </div>

    @section('footer')
        <footer>
            Copyright &copy; : jcluo All rights reserved...
        </footer>
    @show
</body>
</html>