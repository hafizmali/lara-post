@extends('layouts.front')


@section('content')
    @if(!empty($threads))
        @foreach($threads as $thread)
    <div class="content-wrap well">
        <h4>{{$thread->subject}}</h4>
        <hr>

        <div class="thread-details">
            {!! \Michelf\Markdown::defaultTransform($thread->thread)  !!}
        </div>
        <br>
        @if(!empty($thread->tags))
            <div class="form-group">
                <label for="subject">Tags:</label>
                @foreach($thread->tags as $tag)
                    <div class="thread-details">
                        {!! @$tag->name !!}
                    </div>

                @endforeach
            </div>
        @endif

        @if(!empty($thread->video))
            <div class="form-group">
                <label for="subject">Videos:</label>
                @foreach($thread->video->videoDetails as $v_details)
                    <?php $path = getVideo($v_details->filename) ?>
                    <div class="thread-details">
                        <video width="800" height="240" controls>
                            <source src="{!! @$path !!}" type="video/mp4">
                            <source src="{!! @$path !!}" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>

                    </div>

                @endforeach
            </div>
        @endif
        {{--@if(auth()->user()->id == $thread->user_id)--}}
        @if(!empty($thread->subject))
            <div class="actions">

                <form action="{{url('edit-post/'.$thread->id)}}" method="get" class="inline-it">
                    {{csrf_field()}}
                    <input class="btn btn-xs glyphicon-edit" type="submit" value="Edit">
                </form>
                <form action="{{url('delete-post/'.$thread->id)}}" method="get" class="inline-it">
                    {{csrf_field()}}
                    <input class="btn btn-xs btn-danger" type="submit" value="Delete">
                </form>

            </div>
        @endif

    </div>
    <hr>
    <br>




    <br><br>

        @endforeach
    @endif

@endsection


@section('js')

    <script>
        function toggleReply(commentId){
            $('.reply-form-'+commentId).toggleClass('hidden');
        }

    </script>

@endsection
