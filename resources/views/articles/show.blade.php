@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif

    <div class="article-section">
        <div class="profilpicture_min">
            <img src="http://placehold.it/40x40" alt="">
        </div>
        <h4>{{$show->user->name}} a publié un article</h4>
        <small>{{$show->created_at}}</small>
        <h3 class="article-show-name">{{$show->title}}</h3>
        @if(Storage::disk('uploads')->has($show->image))
            <img src="{{route('articles.image', ['filename'=> $show->image])}}" alt="img" class="img-responsive">
        @else
            <img src="{{$show->image}}" alt="img" class="img-responsive">
        @endif
        <p>{{$show->content}}</p>

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

    </div>

    <div class="comment-section">
        <div class="col-md-2">
            <img src="http://placehold.it/80x80" alt="">
        </div>
        <div class="col-md-7">
            <h4 class="comment-title">Title</h4>
            <small class="comment-date">2 fevrier 2018</small>
            <p class="comment-content">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>
        </div>
    </div>


@endsection