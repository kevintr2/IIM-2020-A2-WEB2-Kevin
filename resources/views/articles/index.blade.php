@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="text-center">Liste des articles</h1>
            </div>
        </div>
        <div class="row">
            @if(session('success'))
                <div class="col-md-10 col-md-push-1">
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                </div>
            @endif
            @foreach($articles as $article)
                <div style="background-color:#FFF; margin:10px 0px; padding: 10px;" class="col-md-10 col-md-push-1">

                    <a href="{{route ('articles.show', $article->id)}}"><h3>{{$article->title}}</h3></a>
                    <p>{{$article->content}}</p>
                    <small class="pull-right">publié le {{$article->created_at}} par {{$article->user->name}}</small>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                {{ $articles->links() }}
            </div>
        </div>
    </div>



@endsection