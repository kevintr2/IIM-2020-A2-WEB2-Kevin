<?php $class = $thread->isUnread(Auth::id()) ? 'alert-info' : ''; ?>

<div class="media alert {{ $class }}">
    <h4 class="media-heading">
        <a href="{{ route('messages.show', $thread->id) }}">{{ $thread->participantsString(Auth::id()) }}</a>
        ({{ $thread->userUnreadMessagesCount(Auth::id()) }} non-lu)</h4>
    <p>

    </p>
    <p>
        <small><strong>Nom de la conversation:</strong> {{ $thread->subject }}</small>
    </p>
</div>