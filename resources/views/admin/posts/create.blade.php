@extends('layouts.dashboard')
@section('title', 'New post')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <article>
                    <h1>Crea un nuovo post</h1>
                    <form action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <label for="title">Titolo</label>
                            <input value="{{old('title')}}" type="text" name="title" id="title" class="form-control  
                            @error('title')
                                is-invalid
                            @enderror">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea type="text" name="content" id="content" class="form-control @error('content') is-invalid @enderror">{{old('content')}}</textarea>@error('content') <div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label for="author">Author</label>
                            <input value="{{old('author', Auth::user()->name)}}" type="text" name="author" id="author" class="form-control   
                            @error('author')
                                is-invalid
                            @enderror">
                            @error('author')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="category_id">Categoria</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">-- Seleziona la categoria --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : null }}
                                        >{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="image">Carica un'immagine di copertina: </label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        

                        <div class="d-flex">
                            <div class="form-group w-50">
                                <p>Seleziona i tag:</p>
                                @foreach ($tags as $tag)
                                    <div class="form-check form-check-inline">
                                        <input 
                                        {{in_array($tag->id, old('tags', [])) ? 'checked' : null}}
                                        value="{{ $tag->id }}" type="checkbox" name="tags[]" class="form-check-input" id="{{'tag' . $tag->id}}">
                                        <label class="form-check-label" for="{{'tag' . $tag->id}}">{{ $tag->name }}</label>
                                    </div> 
                                @endforeach
                            </div>
    
                            <div class="form-group w-50">
                                <label for="new_tags">Crea nuovo tag <span class="font-italic">(o pi?? tag separati da virgole)</span></label>
                                <input value="{{old('new_tags')}}" type="text" name="new_tags" id="new_tags" class="form-control">
                            </div>

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