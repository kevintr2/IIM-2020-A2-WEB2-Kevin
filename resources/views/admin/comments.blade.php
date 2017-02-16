@extends('layouts.admin')

@section('content')
@forelse($comments as $comment)
    <div class="comment-section">
        <div class="col-md-2">
            <img src="http://placehold.it/80x80" alt="">
        </div>
        <div class="col-md-10">
            <h4 class="comment-title">{{$comment->user->name}}</h4>
            <small class="comment-date">{{$comment->created_at}}</small>
            <p class="comment-content">{{$comment->content}}</p>
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
        </div>
    </div>
@empty
    <div class="comment-section text-center">
        <h2>Il n'y a aucun commentaire pour cet article</h2>
        <p class="no-comments"><a href="{{ route('admin.articles') }}">Revenir à la liste des articles</a></p>
    </div>
@endforelse
@endsection