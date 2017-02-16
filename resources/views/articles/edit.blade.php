@extends('layouts.app')

@section('pageTitle', 'Editer un article')

@section('content')

    @include('messages.errors')
    <div class="article-section">
        <form method="POST" action="{{route('articles.update', [$edit->id])}}" class="form-horizontal" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" class="form-control" name="title" id="title" value="{{$edit->title}}">
            </div>
            <div class="form-group">
                <label for="content">Contenu</label>
                <textarea class="form-control" id="content" name="content"
                          rows="3">{{$edit->content}}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label> <small>facultatif</small>
                <input id="image" name="image" type="file" class="image">
            </div>
            <button type="submit" class="btn btn-primary">Editer</button>
        </form>
    </div>

@endsection