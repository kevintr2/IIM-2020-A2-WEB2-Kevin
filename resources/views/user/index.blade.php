@extends('layouts.app')

@section('pageTitle', Auth::user()->name)


    @section('content')
        @if(session('success'))
            <div class="col-md-12">
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            </div>
        @endif
        <a href="{{ route('users.edit', Auth::user()->id) }}">
            <button class="btn btn-info pull-right">Modifier mon profil</button>
        </a>
        <h2 class="profile-header">Profil de {{Auth::user()->name}}</h2>

        <hr>

        <div class="profile-content">
            @if(Auth::check())
                <div class="pull-right profilpicture">
                    @if(Storage::disk('uploads')->has(Auth::user()->image))
                        <img src="{{route('articles.image', ['filename'=> Auth::user()->image])}}" alt="img"
                             class="img-responsive">
                    @else
                    @endif
                    @if(!Storage::disk('uploads')->has(Auth::user()->image))
                        <img src="{{ Auth::user()->image }}" alt="img" class="img-responsive">
                    @endif
                </div>
                <ul>
                    <li><b>Nom</b>: {{Auth::user()->name}}</li>
                    <li><b>E-mail</b>: {{Auth::user()->email}}</li>
                    <li><b>Date d'inscription</b>: {{Auth::user()->created_at}}</li>
                </ul>
                <h3>Liste des articles publiés</h3>
                <ul>
                    @foreach($articles as $article)
                        <div style="background-color:#FFF; margin:10px 0px; padding: 10px;" class="col-md-10">

                            <a href="{{ route('articles.show', $article->id) }}"><h3>{{$article->title}}</h3></a>
                            @if(Storage::disk('uploads')->has($article->image))
                                <img src="{{route('articles.image', ['filename'=> $article->image])}}" alt="img" class="img-responsive">
                            @else
                            @endif
                            @if(!Storage::disk('uploads')->has($article->image))
                                @if(is_null(Article::find($article->id)->image))
                                @else
                                    <img src="{{$article->image}}" alt="img" class="img-responsive">
                                @endif
                            @endif
                            <p>{{$article->content}}</p>
                            <small class="pull-right">publié le {{$article->created_at}}
                                par {{$article->user->name}}</small>
                        </div>
                    @endforeach
                </ul>
            @else
                <h2>Vous n'avez pas de profil</h2>
            @endif
        </div>
@endsection
