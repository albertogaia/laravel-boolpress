@extends('layouts.dashboard')
@section('title', $post->title)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <article>
                    <h3 class="mb-3">ID post: {{$post->id}}</h3>
                    @if($post->cover)
	                    <img src="{{ asset('storage/'.$post->cover)}}" alt="{{ $post->title}}">
                    @endif
                    <header class="mb-4">
                        <h1 class="fw bolder mb-1">{{ $post->title }}</h1>
                    </header>
                    @if ($post->category)
                        <div class="text-muded fst-italic mb-2">
                            Author: {{ $post->author }} <br>
                            Category: <a href="{{route('admin.categories.show', $post->category->id)}}">{{$post->category->name}}</a>
                            <br>
                            Tags: 
                            @foreach ($post->tags as $tag)
                                @if ($loop->last)
                                    <a href="{{route('admin.tags.show', $tag->id)}}">{{$tag->name}}</a>
                                @else 
                                    <a href="{{route('admin.tags.show', $tag->id)}}">{{$tag->name}}, </a>
                                @endif
                            @endforeach
                        
                        </div>
                    @else
                        <div class="text-muded fst-italic mb-2">
                            Author: {{ $post->author }} <br>
                            Category: Nessuna categoria di appartenenza</a>
                        </div>
                    @endif
                    
                    <section class="mb-5">
                        <p class="fs-5">
                            {{ $post->content }}
                        </p>
                    </section>
                </article>
                
            </div>
        </div>
    </div>
@endsection