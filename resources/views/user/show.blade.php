@extends('layouts.app')


<div class="article-section">
    @section('content')
        @if(session('success'))
            <div class="col-md-12">
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            </div>
        @endif
    @if(Auth::user()->id == $id)
        <a href="{{ route('users.edit', $show->id) }}">
            <button class="btn btn-info pull-right">Modifier mon profil</button>
        </a>
            @endif
        <h2 class="profile-header">Profil de {{$show->name}}</h2>

        <hr>

        <div class="profile-content">
                <ul>
                    <li><b>Nom</b>: {{$show->name}}</li>
                    <li><b>E-mail</b>: {{$show->email}}</li>
                    <li><b>Date d'inscription</b>: {{$show->created_at}}</li>
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
        </div>
</div>
@endsection
