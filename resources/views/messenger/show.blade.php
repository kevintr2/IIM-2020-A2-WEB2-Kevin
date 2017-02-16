@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <h2 class="text-center">{{ $thread->subject }}</h2>
        @each('messenger.partials.messages', $thread->messages, 'message')

        @include('messenger.partials.form-message')
    </div>
@stop
