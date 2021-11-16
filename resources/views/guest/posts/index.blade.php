@extends('layouts.app')
@section('title', 'Blog')

@section('content')
<div class="container d-flex">
    @foreach ($posts as $post)
    <div class="card m-2" style="width: 18rem;">
        <img src="{{ asset('storage/'.$post->cover)}}" class="card-img-top" alt="...">
        <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
        <p class="card-text">{{ $post->author }}</p>
        <a href="{{route('posts.show', $post->slug)}}" class="btn btn-primary">Leggi l'articolo</a>
        </div>
    </div>
    @endforeach
    </div>
</div>
@endsection