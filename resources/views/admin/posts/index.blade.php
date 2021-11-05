@extends('layouts.dashboard')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <ul>
        @foreach ($posts as $post)
            <li><a href="{{ route('admin.posts.show', $post->id) }}">{{$post->title}}</a></li>
            
            <a href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>

            <form action="{{route('admin.posts.destroy', $post->id)}}" class="d-inline-block delete-post" method="post">
                @csrf
                @method('DELETE')
                <button type="submit">DELETE</button>
            </form>
        @endforeach
    </ul>
@endsection