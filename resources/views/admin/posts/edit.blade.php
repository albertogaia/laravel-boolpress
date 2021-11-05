@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <article>
                    <h1>Modifica Post</h1>
                    <form action="{{route('admin.posts.update', $post->id)}}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="title">Titolo</label>
                            <input value="{{old('title', $post->title)}}" type="text" name="title" id="title" class="form-control  
                            @error('title')
                                is-invalid
                            @enderror">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea type="text" name="content" id="content" class="form-control">{{old('content', $post->content)}}">
                            </textarea>
                            @error('thumbnail')
                                    <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="thumbnail">Thumbnail</label>
                            <input value="{{old('thumbnail', $post->thumbnail)}}" type="text" name="thumbnail" id="thumbnail" class="form-control">
                        </div>

                        <div class="form-group">
                            <button onclick="window.confirmDelete();" type="submit" class="btn btn-success">Modifica</button>
                        </div>

                    </form>
                </article>
                
            </div>
        </div>
    </div>
@endsection