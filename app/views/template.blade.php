<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hello</title>
    <link href="/jscss/webside/css/layout.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/jscss/jquery/jquery-1.11.0.min.js"></script>
    <!--script type="text/javascript" src="/jscss/starter-kit-1.5.1"></script-->
    <link href="/jscss/bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/jscss/bootstrap-3.2.0-dist/css/docs.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/jscss/bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/jscss/EpicEditor/js/epiceditor.min.js"></script>
    <script type="text/javascript" src="/jscss/webside/js/layouot.js"></script>
    <script type="text/javascript" src="/jscss/webside/js/message.js"></script>
    <script type="text/javascript">
        var epic_opts = {
            container: 'epiceditor',
            textarea: null,
            basePath: '',
            clientSideStorage: true,
            localStorageName: null,
            useNativeFullscreen: true,
            parser: marked,
            file: {name: 'epiceditor', defaultContent: '', autoSave: 100 },
            theme: {
                base: '/jscss/EpicEditor/themes/base/epiceditor.css',
                preview: '/jscss/EpicEditor/themes/preview/preview-dark.css',
                editor: '/jscss/EpicEditor/themes/editor/epic-dark.css'
            },
            button: {preview: true, fullscreen: true, bar: "auto"},
            focusOnLoad: false,
            shortcut: {modifier: 18, fullscreen: 70, preview: 80 },
            string: {
                togglePreview: 'Toggle Preview Mode',
                toggleEdit: 'Toggle Edit Mode',
                toggleFullscreen: 'Enter Fullscreen'
            },
            autogrow: false
        };
    </script>
</head>
<body>
    @section('header')
        <header>
            <div id="login-panel" >
                @if ( ! empty($user) )
                    <a href="/logout" class="btn btn-info" > 登出 </a>
                @else
                    <a type="submit" id="login-button" class="btn btn-default" href="<?= $login_url ?>" > 登入 </a>
                @endif
            </div>
            <div id="user-info">
                @if( !empty($user) )
                    Welcome！ <?= $user->firstname ?> .
                @endif
            </div>
            <ul id="header-menu" class="nav nav-pills">
                @foreach( $header_menu['menu'] as $tag => $name )
                    <li class="<?= ($header_menu['active']==$tag ? 'active' : '') ?>">
                        <a href="/<?= $tag ?>"><?= $name ?></a>
                    </li>
                @endforeach
            </ul>
            <div id="alert-message"> &nbsp; </div>
        </header>
    @show
    
    <div id="main" >
        @yield('sidebar')

        @yield('content')

    </div>

    @section('footer')
        <footer >
            Copyright &copy; : jcluo All rights reserved.
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

    @yield('script')

</body>
</html>