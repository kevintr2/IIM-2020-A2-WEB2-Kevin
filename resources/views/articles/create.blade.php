@extends('layouts.app')

@section('pageTitle', 'Créer un article')

@section('content')

        @include('messages.errors')
        <h2 class="text-center">Publier un nouvel article</h2>

                <form method="post" action="{{route('articles.store')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" class="form-control" name="title" id="title"
                               placeholder="Titre de votre article..">
                    </div>
                    <div class="form-group">
                        <label for="content">Contenu</label>
                        <textarea class="form-control" id="content" name="content" rows="3"
                                  placeholder="Contenu de votre article.."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input id="image" name="image" type="file" class="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Publier</button>
                </form>

@endsection