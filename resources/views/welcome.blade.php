<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

    <title>Fitclub</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400" rel="stylesheet">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <style>
        html, body {
            background-color: #f5f5f5;
            color: #636b6f;
            font-family: 'Montserrat', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
            width: 100vw;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }
        
        .content a{
            text-decoration: none;
            color:#5a5959;
        }

        .content a:hover{
            color:#adabab;
        }

        .title {
            font-size: 150px;
            font-variant: small-caps;
            font-weight: 400;
            line-height: 0.9;
        }

        .fit {
            color: #49849d;
        }

        .subtitle {
            font-size: 17px;
            font-variant: small-caps;
            font-weight: 300;
            letter-spacing: 12px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 50px;
        }

        #section-1 {
            background-image: url({{URL::asset('images/sectionbg.jpg')}});
            background-size: cover;
            overflow: hidden;
            height: 540px;
            width: 100vw;
        }

        #section-1 h2 {
            font-size: 45px;
            font-variant: small-caps;
            color: #8fcbe4;
        }

        #section-1 p {
            color: #f9f9f9;
            width: 300px;
            margin: 0 auto;
            text-align: justify;
        }

        .paragraphs {
            padding-bottom: 180px;
        }

        .overlay {
            width: 100%;
            height: 100%;
            background: rgba(39, 71, 80, 0.9);
            overflow: hidden;
            z-index: 2;
        }

        .titles {
            padding-top: 180px;
        }

        .btn-info {
            font-family: 'Raleway', sans-serif;
            font-size: 14px;
            font-variant: small-caps;
            font-weight: 100;
        }

        .moreaboutit {
            position: absolute;
            bottom: 10px;
            margin: 0 auto;
            width: 100%;
            left: 0;
        }

        .more {
            margin: 0;
            font-size: 14px;
            font-variant: small-caps;
            font-weight: 100;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @if (Auth::check())
                <a href="{{ url('/home') }}">Accueil</a>
            @else
                <a href="{{ url('/login') }}">Se connecter</a>
                <a href="{{ url('/register') }}">Inscription</a>
            @endif
        </div>
    @endif

    <div class="content">
        <div class="title">
            <span class="fit">fit</span>club
        </div>
        <div class="subtitle m-b-md">repousse tes limites</div>
        <a href="{{ url('/register') }}"><button class="btn btn-info">nous rejoindre</button></a>
        <a class="js-scrollTo" href="#section-1">
            <div class="moreaboutit">
                <p class="more">en savoir plus</p>
                <i class="fa fa-chevron-down" aria-hidden="true"></i>
            </div>
        </a>
    </div>
</div>

<div id="section-1">
    <div class="overlay">
        <div class="titles">
            <div class="col-md-4 text-center">
                <h2>progresser</h2>
            </div>
            <div class="col-md-4 text-center">
                <h2>motiver</h2>
            </div>
            <div class="col-md-4 text-center">
                <h2>partager</h2>
            </div>
        </div>
        <div class="paragraphs">
            <div class="col-md-4 text-center">
                <p>Continue à progresser grâce aux différents entraînements proposés par la communauté. Apprends à mieux
                    gérer
                    ta diète grâce aux conseils de chacun.</p>
            </div>
            <div class="col-md-4 text-center">
                <p>Un coup de mou, un manque d'envie? Ici tu n'es plus seul, toute la communauté est derrière toi pour
                    t'encourager
                    à aller de l'avant, certains auront besoin de toi !</p>
            </div>
            <div class="col-md-4 text-center">
                <p>Découvre toutes les évolutions et tous les conseils des membres de Fitclub. Viens toi aussi partager
                    ton histoire,
                    ton évolution et tes conseils.</p>
            </div>
        </div>
    </div>
</div>

<script src="https://use.fontawesome.com/e98963dbe8.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('.js-scrollTo').on('click', function () { // Au clic sur un élément
            var page = $(this).attr('href'); // Page cible
            var speed = 950; // Durée de l'animation (en ms)
            $('html, body').animate({scrollTop: $(page).offset().top}, speed); // Go
            return false;
        });
    });
</script>
</body>
</html>
