@extends('layouts.app')

@section('pageTitle', $show->title)

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif

    <div class="article-section extendpadding" data-articleid="{{ $show->id }}">
        <div class="profilpicture_min">
            @if(Storage::disk('uploads')->has($show->user->image))
                <img src="{{route('articles.image', ['filename'=> $show->user->image])}}" alt="img"
                     class="img-responsive">
            @else
            @endif
            @if(!Storage::disk('uploads')->has($show->user->image))
                <img src="{{ $show->user->image }}" alt="img" class="img-responsive">
            @endif
        </div>
        <h4><a href="">{{$show->user->name}}</a> a publié un article</h4>
        <small>{{$show->created_at}}</small>
        <div class="pull-right">@include('/share', ['url' => url(route('articles.show', $show->id))])</div>
        <h3 class="article-show-name">{{$show->title}}</h3>
        @if(Storage::disk('uploads')->has($show->image))
            <img src="{{route('articles.image', ['filename'=> $show->image])}}" alt="img" class="img-responsive">
        @else
        @endif
        @if(!Storage::disk('uploads')->has($show->image))
            @if(is_null(Article::find($show->id)->image))
            @else
                <img src="{{$show->image}}" alt="img" class="img-responsive">
            @endif
        @endif
        <p>{{$show->content}}</p>
        @if( $admin == 1 || $show->user_id == Auth::user()->id)
        <div class="cudbtn pull-right text-right">
            <form method="POST" action="{{route('articles.destroy', [$show->id])}}" class="form-horizontal">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-primary">Supprimer</button>
            </form>
        </div>
        <div class="cudbtn pull-right text-right">
            <a href="{{route('articles.edit', $show->id)}}">
                <button class="btn btn-primary">Editer</button>
            </a>
        </div>
        @endif
        <div class="col-md-12 likebuttons text-center">
            <a href="#" class="button-like like"> {{ Auth::user()->likes()->where('article_id', $show->id)->first() ? Auth::user()->likes()->where('article_id', $show->id)->first()->like == 1 ? 'J\'ai aimé' : 'J\'aime' : 'J\'aime'}}</a>
            <a href="#" class="button-dislike like"> {{ Auth::user()->likes()->where('article_id', $show->id)->first() ? Auth::user()->likes()->where('article_id', $show->id)->first()->like == 0 ? 'J\'ai pas aimé' : 'J\'aime pas' : 'J\'aime pas'}}</a>
        </div>
        <div class="col-md-12 text-center">
            <p class="likeCounter"><i class="fa fa-thumbs-o-up"></i> {{Like::where('article_id', $show->id)->where('like', 1)->count()}} </p> |
            <p class="likeCounter">{{Like::where('article_id', $show->id)->where('like', 0)->count()}} <i class="fa fa-thumbs-o-down"></i></p>
        </div>


    </div>

    @foreach($comments as $comment)
        <div id="comment-section" class="comment-section">
            <div class="col-md-2 profilpicture">
                @if(Storage::disk('uploads')->has($comment->user->image))
                    <img src="{{route('articles.image', ['filename'=> $comment->user->image])}}" alt="img"
                         class="img-responsive">
                @else
                @endif
                @if(!Storage::disk('uploads')->has($comment->user->image))
                    <img src="{{ $comment->user->image }}" alt="img" class="img-responsive">
                @endif
            </div>
            <div class="col-md-10">
                <h4 class="comment-title">{{$comment->user->name}}</h4>
                <small class="comment-date">{{$comment->created_at}}</small>
                <p class="comment-content">{{$comment->content}}</p>
                @if( $admin == 1 || $comment->user->id == Auth::user()->id)
                <ul>
                    <li><a href="{{route('comments.edit', $comment->id)}}">Editer</a></li>
                    <li>|</li>
                    <li>
                        <form method="POST" action="{{route('comments.destroy', [$comment->id])}}"
                              class="form-horizontal">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-link">Supprimer</button>
                        </form>
                    </li>
                </ul>
                @endif
            </div>
        </div>
    @endforeach

    <div class="col-md-12 comment-write">
        <div class="col-md-10 col-md-offset-1">
            <form method="post" action="{{route('comments.store', $show->id)}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="content">Commentaire</label>
                    <textarea class="form-control" id="content" name="content" rows="3"
                              placeholder="Contenu de votre commentaire.."></textarea>
                </div>
                <button type="submit" class="btn btn-primary pull-right">Commenter</button>
            </form>
        </div>
    </div>

    <script>
        var token = '{{Session::token()}}';
        var urlLike = '{{ route('like') }}';
    </script>
@endsection