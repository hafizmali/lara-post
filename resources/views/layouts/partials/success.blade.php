@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

@if (session('error_message'))
    <div class="alert alert-success">
        {{ session('error_message') }}
    </div>
@endif
