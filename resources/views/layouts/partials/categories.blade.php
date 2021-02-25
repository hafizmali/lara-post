<div class="col-md-3">

    <a class="btn btn-success form-control"  href="{{route('create-post')}}">Create Post</a> <br><br>
    <h4>Tags</h4>
    <ul class="list-group">
        <a href="{{ url('show-post') }}" class="list-group-item">
            <span class="badge">{!! @count($threads) !!}</span>
            All Post
        </a>
    </ul>
</div>
