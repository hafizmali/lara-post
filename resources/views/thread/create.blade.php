@extends('layouts.front')

@section('heading',"Create Post")

@section('content')


    <div class="row">
        <div class=" well">
            <form class="form-vertical" action="{{route('create-post')}}" method="post" role="form"
                  id="create-thread-form">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" name="subject" id="" placeholder="Type your Subject..."
                           value="{{old('subject')}}">
                </div>


                <div class="form-group">
                    <label for="tag">Tags</label>
                    @if(!empty($tags))
                        @foreach($tags as $tag)
                            <input type="text" name="tags[]" class="form-control" value="{{$tag->name}}" placeholder="Type your tag E.G a,b,c" data-role="tagsinput"/>
                        @endforeach
                    @else
                        <input type="text" class="form-control" name="tags[]" value="" data-role="tagsinput"/>
                    @endif

                </div>

                <div class="form-group">
                    <label for="thread">Comments</label>
                    <textarea class="form-control" name="thread" id="" placeholder="Type Your Descriptions"
                    > {{old('thread')}}</textarea>
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
