@extends('layouts.dashboard')
@section('title', "Categoria: $category->name")

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Categoria: {{$category->name}}</h2>
                <h4>Slug: {{$category->slug}}</h4>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
            <h2>Lista dei post collegati alla categoria:</h2>
            @if ($category->posts->isNotEmpty())
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col"># ID</th>
                        <th scope="col">Titolo</th>
                        <th class="text-center" scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($category->posts as $post)
                            <tr>
                                <th scope="row">{{$post->id}}</th>
                                <td><a href="{{ route('admin.posts.show', $post->id) }}">{{$post->title}}</a></td>
                                <td class="text-center">
                                    <a class="mx-2 text-reset btn btn-warning" href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
                                    <form action="{{route('admin.posts.destroy', $post->id)}}" class="d-inline-block delete-post" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger mx-2" type="submit">DELETE</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-danger"><h3>:( Non ci sono ancora post con questa categoria</h3></div>
            @endif
            </div>
        </div>
    </div>
@endsection