@extends('layouts.app')

@section('pageTitle', 'Nouveau message')

@section('content')
    <div >
    <h1 class="text-center">Commencer une nouvelle discussion</h1>
        <hr>
    <form action="{{ route('messages.store')}}" method="post">
        {{ csrf_field() }}
        <div class="col-md-12">
            @if($users->count() > 0)
                <div class="form-group">
                    <label class="control-label">Destinataire</label>
                    <select name="test" class="form-control" id="sel1">
                        @foreach($users as $user)

                            <option value="{{ $user->id }}">{!!$user->name!!}</option>

                        @endforeach
                    </select>
                </div>
        @endif

            <!-- Subject Form Input -->
            <div class="form-group">
                <label class="control-label">Titre de la conversation</label>
                <input type="text" class="form-control" name="subject" placeholder="Conversation de .. et .."
                       value="{{ old('subject') }}">
            </div>

            <!-- Message Form Input -->
            <div class="form-group">
                <label class="control-label">Message</label>
                <textarea name="message" class="form-control">{{ old('message') }}</textarea>
            </div>


    
            <!-- Submit Form Input -->
                <div class="col-md-2 col-md-offset-5">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary form-control"><i style="margin-right:2px;" class="fa fa-paper-plane"></i> Envoyer </button>
                    </div>
                </div>

        </div>
    </form>
    </div>
@stop
