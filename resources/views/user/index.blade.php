@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Profil de {{Auth::user()->name}}</div>

                    <div class="panel-body">
                        @if(Auth::check())
                            <h2>Profil</h2>
                            <ul>
                                <li>Nom: {{Auth::user()->name}}</li>
                                <li>E-mail: {{Auth::user()->email}}</li>
                                <li>Date d'inscription: {{Auth::user()->created_at}}</li>
                            </ul>
                        @else
                            <h2>Vous n'avez pas de profil</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection