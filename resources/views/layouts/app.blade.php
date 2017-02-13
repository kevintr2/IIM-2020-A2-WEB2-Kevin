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

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

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
                <a class="navbar-brand" href="{{ url('/') }}">
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
                    <a href="{{route('users.index')}}"><li><i class="fa fa-user-circle" aria-hidden="true"></i> Voir mon profil</li></a>
                    <a href=""><li><i class="fa fa-pencil xtramargin" aria-hidden="true"></i> Modifier mon profil</li></a>
                    <a href=""><li><i class="fa fa-list-alt" aria-hidden="true"></i> Voir mes articles</li></a>
                    <hr>
                    <a href=""><li><i class="fa fa-comment" aria-hidden="true"></i> Messagerie</li></a>
                    <hr>
                    <a href=""><li><i class="fa fa-book" aria-hidden="true"></i> Entraînements</li></a>
                    <a href=""><li><i class="fa fa-cutlery xtramargin" aria-hidden="true"></i> Nutrition</li></a>
                    <a href=""><li><i class="fa fa-globe" aria-hidden="true"></i> Motivation</li></a>
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
<script src="/js/app.js"></script>
<script src="https://use.fontawesome.com/f60a75a105.js"></script>
</body>
</html>
