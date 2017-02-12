@if (count($errors) > 0 )
    <div class="row">
        <div class="alert alert-danger col-md-10 col-md-offset-1">
            <ul>
                @foreach($errors->all() as $error)
                    <li style="color:red;">{{$error}}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif