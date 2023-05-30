@if (session('status'))
    <div class="alert alert-success my-3">
        {{ session('status') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger my-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif