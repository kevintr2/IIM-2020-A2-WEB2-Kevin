<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- FONTS !-->

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"  integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <style>
        body {
            padding-top: 70px;
        }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url(route('articles.index')) }}">
                    <div class="nav-title">
                        <span class="nav-fit">fit</span>club
                    </div>
                    <div class="nav-subtitle">repousse tes limites</div>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">
        <div class="col-md-3">
            <div class="sidebar">
                <ul>
                    <a href="{{route('articles.index')}}"><li><i class="fa fa-globe" aria-hidden="true"></i> Fil d'actualité</li></a>
                    <a href="{{route('articles.create')}}"><li><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Rédiger un article</li></a>
                    <hr>
                    <a href="{{route('users.index')}}"><li><i class="fa fa-user-circle" aria-hidden="true"></i> Voir mon profil</li></a>
                    <a href="{{route('users.edit', Auth::user()->id)}}"><li><i class="fa fa-pencil xtramargin" aria-hidden="true"></i> Modifier mon profil</li></a>
                    <hr>
                    <a href="/messenger/create"><li><i class="fa fa-comment" ></i> Écrire un message</li></a>
                    <a href="/messenger"><li><i class="fa fa-comments"></i> Messages @include('messenger.unread-count')</li></a>
                    <hr>
                    <a href="{{route('contact.index')}}"><li><i class="fa fa-envelope" aria-hidden="true"></i> Nous contacter</li></a>
                    <hr>
                    @if(Auth::user()->admin == 1)
                        <a href="{{route('admin.index')}}"><li><i class="fa fa-user-secret" aria-hidden="true"></i> Panneau d'administration</li></a>
                    @else

                    @endif
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <li><i class="fa fa-sign-out" aria-hidden="true"></i> Se déconnecter</li>
                    </a>
                </ul>
            </div>
        </div>
        <div class="content-block col-md-9">
            @yield('content')
        </div>
        <div class="col-md-12">
            @yield('pagination')
        </div>
    </div>

</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="/js/myjs.js"></script>
<script src="/js/app.js"></script>
<script src="https://use.fontawesome.com/f60a75a105.js"></script>
<script>

    var popupSize = {
        width: 780,
        height: 550
    };

    $(document).on('click', '.social-buttons > a', function(e){

        var
            verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
            horisontalPos = Math.floor(($(window).height() - popupSize.height) / 2);

        var popup = window.open($(this).prop('href'), 'social',
            'width='+popupSize.width+',height='+popupSize.height+
            ',left='+verticalPos+',top='+horisontalPos+
            ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

        if (popup) {
            popup.focus();
            e.preventDefault();
        }

    });
</script>
</body>
</html>
