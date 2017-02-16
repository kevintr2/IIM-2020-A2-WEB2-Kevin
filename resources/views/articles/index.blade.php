@extends('layouts.app')

@section('pageTitle', 'Accueil')

@section('content')
    @if(session('success'))
        <div class="col-md-12">
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        </div>
    @endif
    @foreach($articles as $article)
        <div class="article-section" data-articleid="{{ $article->id }}">
            <div class="profilpicture_min">
                @if(Storage::disk('uploads')->has($article->user->image))
                    <img src="{{route('articles.image', ['filename'=> $article->user->image])}}" alt="img"
                         class="img-responsive">
                @else
                @endif
                @if(!Storage::disk('uploads')->has($article->user->image))
                    <img src="{{ $article->user->image }}" alt="img" class="img-responsive">
                @endif

            </div>
            <h4><a href="{{ route('users.show', $article->user->id) }}">{{$article->user->name}}</a> a publié <a
                        href="{{route ('articles.show', $article->id)}}">un
                    article</a></h4>
            <small>{{$article->created_at->diffForHumans()}}</small>
            <div class="pull-right">
                @include('/share', ['url' => url(route('articles.show', $article->id))])
            </div>
            <h3 class="article-show-name">{{$article->title}}</h3>
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
            <p class="article-p">{{$article->content}}</p>
            <div class="col-md-12 likebuttons text-center">
                <a href="#"
                   class="button-like like"> {{ Auth::user()->likes()->where('article_id', $article->id)->first() ? Auth::user()->likes()->where('article_id', $article->id)->first()->like == 1 ? 'J\'ai aimé' : 'J\'aime' : 'J\'aime'}}</a>
                <a href="#"
                   class="button-dislike like"> {{ Auth::user()->likes()->where('article_id', $article->id)->first() ? Auth::user()->likes()->where('article_id', $article->id)->first()->like == 0 ? 'J\'ai pas aimé' : 'J\'aime pas' : 'J\'aime pas'}}</a>
            </div>
            <div class="like-counter col-md-12 text-center">
                <p class="likeCounter"><i
                            class="fa fa-thumbs-o-up"></i> {{Like::where('article_id', $article->id)->where('like', 1)->count()}}
                </p> |
                <p class="likeCounter">{{Like::where('article_id', $article->id)->where('like', 0)->count()}} <i
                            class="fa fa-thumbs-o-down"></i></p>
            </div>
            @if(Comment::where('article_id', $article->id)->count() > 1)
                <h5 class="text-center">Il y a {{Comment::where('article_id', $article->id)->count()}} commentaires. |
                    <a href="{{ route('articles.show', $article->id) }}#comment-section">Afficher les commentaires.</a>
                </h5>
            @elseif(Comment::where('article_id', $article->id)->count() == 1)
                <h5 class="text-center">Il y a {{Comment::where('article_id', $article->id)->count()}} commentaire. | <a
                            href="{{ route('articles.show', $article->id) }}#comment-section">Afficher le
                        commentaire.</a></h5>
            @else
                <h5 class="text-center">Aucun commentaire pour cet article.</h5>
            @endif


        </div>
    @endforeach
@stop
@section('pagination')
    <div class="row">
        <div class="text-center">
            {{ $articles->links() }}
        </div>
    </div>


    <script>
        var token = '{{Session::token()}}';
        var urlLike = '{{ route('like') }}';
    </script>
@endsection