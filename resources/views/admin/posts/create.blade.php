@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <article>
                    <h1>Vista Create Post</h1>
                    <form action="{{route('posts.store')}}" method="post">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <label for="title">Titolo</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="content">Titolo</label>
                            <textarea type="text" name="content" id="content" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="thumbnail">Thumbnail</label>
                            <textarea type="text" name="thumbnail" id="thumbnail" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Crea post</button>
                        </div>

                    </form>
                </article>
                
            </div>
        </div>
    </div>
@endsection