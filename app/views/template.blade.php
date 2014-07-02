<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hello</title>
    <link href="/sslibs/bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/sslibs/webside/css/layout.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/sslibs/jquery/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="/sslibs/bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/sslibs/webside/js/layouot.js"></script>
    <script type="text/javascript" src="/sslibs/webside/js/message.js"></script>
</head>
<body>
    @section('header')
        <header>
            <div id="login-panel" >
                @if ( ! empty($user) )
                    <a href="/logout" class="btn btn-warning" > 登出 </a>
                @else
                    <a type="submit" id="login-button" class="btn btn-info" href="{{ $login_url }}" > 登入 </a>
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


    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">訊息</h4>
                </div>
                <div class="modal-body">
                    <p id="login-message"> 
                    </p>
                    <iframe id="login-iframe" class="hide"></iframe>
                </div>
            </div>
        </div>
    </div>

</body>
</html>