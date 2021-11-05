@extends('layouts.dashboard')

@section('content')
    <ul>
        @foreach ($posts as $post)
            <li><a href="{{ route('admin.posts.show', $post->id) }}">{{$post->title}}</a></li>
            <a href="">Delete</a>
            <a href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
        @endforeach
    </ul>
@endsection