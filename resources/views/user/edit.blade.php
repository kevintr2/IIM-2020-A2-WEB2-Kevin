@extends('layouts.app')

@section('content')

    @include('messages.errors')
    <div class="article-section">
        <form method="POST" action="{{ route('users.update', $id) }}" class="form-horizontal" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" name="name" id="name" value="{{$edit->name}}">
            </div>
            <div class="form-group">
                <label for="email">Adresse Mail</label>
                <input type="text" class="form-control" name="email" id="email" value="{{$edit->email}}">
            </div>
           <!-- <div class="form-group">
                <label for="image">Image</label> <small>facultatif</small>
                <input id="image" name="image" type="file" class="image">
            </div> -->
            <button type="submit" class="btn btn-primary">Editer</button>
        </form>
    </div>

@endsection