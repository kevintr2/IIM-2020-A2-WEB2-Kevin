@extends('layouts.app')

@section('content')
            @if(session('success'))
                <div class="col-md-10 col-md-push-1">
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                </div>
            @endif
            @foreach($articles as $article)
                <div class="article-section">

                    <a href="{{route ('articles.show', $article->id)}}"><h3 class="article-index-name">{{$article->title}}</h3></a>
                    @if(Storage::disk('uploads')->has($article->image))
                        <img src="{{route('articles.image', ['filename'=> $article->image])}}" alt="img" class="img-responsive">
                    @else
                        <img src="{{$article->image}}" alt="img" class="img-responsive">
                    @endif

                    <p>{{$article->content}}</p>
                    <small class="pull-right">publié le {{$article->created_at}} par {{$article->user->name}}</small>
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