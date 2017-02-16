@extends('layouts.admin')

@section('pageTitle', 'Panneau d\'administrateur')

@section('content')

    @if(session('success'))
        <div class="col-md-12">
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        </div>
    @endif

    @forelse($messages as $message)
        <div class="comment-section">
            <div class="col-md-12">
                <h4 class="comment-title">{{$message->name}}</h4>
                <small><i>{{ $message->email }}</i></small>
                <small class="comment-date pull-right">{{$message->created_at}}</small>
                <p class="comment-content">{{$message->message}}</p>
            </div>

            <div class="pull-right text-right">
                <form method="POST" action="{{route('contact.destroy', [$message->id])}}" class="form-horizontal">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-primary">Supprimer</button>
                </form>
            </div>

        </div>
    @empty
        <div class="comment-section text-center">
            <h2>Il n'y a aucun message pour le moment</h2>
        </div>
    @endforelse
@endsection