@extends('layouts.app')

@section('content')

    @include('messages.errors')

    <div class="article-section">
        <form method="POST" action="{{route('comments.update', [$edit->id])}}" class="form-horizontal">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="content">Commentaire</label>
                <textarea class="form-control" id="content" name="content"
                          rows="3">{{$edit->content}}</textarea>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Editer</button>
        </form>
    </div>

@endsection