@extends('layouts.app')

@section('pageTitle', 'Nous contacter')

@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif

    @include('messages.errors')

    <div class="article-section">
        <h3 class="text-center">Contactez-nous {{ Auth::user()->name }} !</h3>
                <form method="post" action="{{ route('contact.store') }}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="email">Adresse Mail</label>
                        <input type="email" class="form-control" name="email" id="email"
                               placeholder="Votre adresse mail ..">
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="3"
                                  placeholder="Votre message.."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Envoyer <i class="fa fa-send"></i></button>
                </form>
    </div>
@endsection