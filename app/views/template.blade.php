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
                @if ( ! empty($user) )
                    <a href="/ajax/logout" class="btn btn-warning" > 登出 </a>
                @else
                    <form id="login-form" action="/ajax/login" method="post" >
                        <input type="hidden" name="" value="<?= csrf_token() ?>" />
                        <input type="password" name="my-password" class="form-control" placeholder=" Password." />
                        <button type="submit" id="login-button" class="btn btn-info" > 登入 </button>
                    </form>
                @endif
            </div>
            <ul class="nav nav-pills">
                @foreach( $header_menu['menu'] as $tag => $name )
                    <li class="<?= ($header_menu['active']==$tag ? 'active' : '') ?>">
                        <a href="/<?= $tag ?>"><?= $name ?></a>
                    </li>
                @endforeach
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