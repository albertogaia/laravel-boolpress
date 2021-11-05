@extends('layouts.dashboard')
@section('title', $post->title)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <article>
                    <h3 class="mb-3">ID post: {{$post->id}}</h3>
                    <header class="mb-4">
                        <h1 class="fw bolder mb-1">{{ $post->title }}</h1>
                    </header>
                    <div class="text-muded fst-italic mb-2">Author: {{ $post->author }}</div>
                    <figure class="mb-4">
                        <img src="{{ $post->thumbnail }}" alt="" class="img-fluid rounded">
                    </figure>
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