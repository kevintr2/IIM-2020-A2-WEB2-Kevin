@extends('layouts.admin')

@section('pageTitle', 'Panneau d\'administrateur')

@section('content')
    @if(session('success'))
        <div class="col-md-10 col-md-push-1">
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        </div>
    @endif
    @foreach($articles as $article)
        <div class="article-section" data-articleid="{{ $article->id }}">
            <div class="profilpicture_min">
                <img src="http://placehold.it/40x40" alt="">
            </div>
            <h4><a href="">{{$article->user->name}}</a> a publié <a href="{{route ('articles.show', $article->id)}}">un
                    article</a></h4>
            <small>{{$article->created_at->diffForHumans()}}</small>
            <div class="pull-right">
                <ul>
                    <li><a href="{{ route('articles.edit', $article->id) }}">Editer</a></li> |
                    <li><a href="{{ route('articles.destroy', $article->id) }}">Supprimer</a></li> |
                    <li><a href="{{ route('admin.comments', $article->id) }}">Afficher les commentaires</a></li>
                </ul>
            </div>
            <h3 class="article-show-name">{{$article->title}}</h3>
            @if(Storage::disk('uploads')->has($article->image))
                <img src="{{route('articles.image', ['filename'=> $article->image])}}" alt="img" class="img-responsive">
            @else
                <img src="{{$article->image}}" alt="img" class="img-responsive">
            @endif
            <p>{{$article->content}}</p>
            <div class="col-md-12 text-center">
                <p class="likeCounter"><i class="fa fa-thumbs-o-up"></i> {{Like::where('article_id', $article->id)->where('like', 1)->count()}} </p> |
                <p class="likeCounter">{{Like::where('article_id', $article->id)->where('like', 0)->count()}} <i class="fa fa-thumbs-o-down"></i></p>
            </div>


        </div>
    @endforeach
@stop
@section('pagination')
    <div class="row">
        <div class="text-center">
            {{ $articles->links() }}
        </div>
    </div>


@endsection