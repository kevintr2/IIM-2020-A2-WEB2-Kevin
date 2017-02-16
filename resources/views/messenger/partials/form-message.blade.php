<h3 style="margin-top:50x;">Répondre</h3>
<form action="{{ route('messages.update', $thread->id) }}" method="post">
    {{ method_field('put') }}
    {{ csrf_field() }}
        
    <!-- Message Form Input -->
    <div class="form-group">
        <textarea name="message" class="form-control">{{ old('message') }}</textarea>
    </div>


    <!-- Submit Form Input -->
        <div class="col-md-2 col-md-offset-5">
    <div class="form-group">
        <button type="submit" class="btn btn-primary form-control"><i style="margin-right:2px;" class="fa fa-paper-plane"> </i> Envoyer</button>
    </div>
        </div>
</form>