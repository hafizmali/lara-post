@extends('layouts.front')

@section('heading')
    <h4>Edit Post</h4>
@endsection

@section('content')

    @include('layouts.partials.error')

    @include('layouts.partials.success')

    <div class="row">
        <div class=" well">
            <form class="form-vertical" action="{{route('post-update')}}" method="post" role="form"
                  id="create-thread-form">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" name="subject" id="" placeholder=""
                           value="{{$thread->subject}}">
                </div>

                <input type="hidden" name="thread_id" value="{!! @$thread_id !!}">
                <div class="form-group">
                    <label for="tag">Tags</label>
                    @if(!empty($thread->tags))
                        @php $t = []; @endphp
                        @foreach($thread->tags as $tag)
                          @php
                              $t[] = @$tag->name;
                           @endphp
                        @endforeach

                            <input type="text" name="tags[]" class="form-control" value="{{@$t[0]}}" placeholder="Type your tag E.G a,b,c" data-role="tagsinput"/>

                    @endif

                </div>

                <div class="form-group">
                    <label for="thread">Thread</label>
                    <textarea class="form-control" name="thread" id="" placeholder=""> {{$thread->thread}} </textarea>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">Videos(can attach more than one): </label>
                    <div class="col-md-8">
                        <input type="file" class="form-control" name="videos[]" multiple />

                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular.min.js"></script>
    <script src="{{asset('tag/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{asset('tag/bootstrap-tagsinput-angular.min.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/standalone/selectize.min.js"></script>

    <script>

        $(function () {
            $('#tag').selectize();
        })
    </script>
@endsection
