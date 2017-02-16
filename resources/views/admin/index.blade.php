@extends('layouts.admin')

@section('content')
        <div class="comment-section text-center">
            <h2>Bienvenue {{ Auth::user()->name }}, sur le panneau d'administration</h2>
            <p class="no-comments"><a href="{{ route('admin.articles') }}">Gérer les articles</a></p>
        </div>
@endsection