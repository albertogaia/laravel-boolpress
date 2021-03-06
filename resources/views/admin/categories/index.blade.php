@extends('layouts.dashboard')
@section('title', 'All categories')
@section('content')
    @if (session('updated'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('updated') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
      </div>
    @endif
    @if (session('inserted'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('inserted') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
      </div>
    @endif
    @if (session('deleted'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('deleted') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
      </div>
    @endif

    <div class="row mb-3">
        <div class="col-12">
            <div class="float-right">
                <div class="btn btn-success"><a class="text-reset" href="{{route('admin.categories.create')}}">Nuova Categoria</a></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col"># ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">N° Posts</th>
                    <th class="text-center" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <th scope="row">{{$category->id}}</th>
                            <td><a href="{{ route('admin.categories.show', $category->id) }}">{{$category->name}}</a></td>
                            <td><a href="{{ route('admin.categories.show', $category->id) }}">{{count($category->posts)}}</a></td>
                            <td class="text-center">
                                <a class="mx-2 text-reset btn btn-success" href="{{ route('admin.categories.show', $category->id) }}">Visualizza</a>
                                <a class="mx-2 text-reset btn btn-warning" href="{{ route('admin.categories.edit', $category->id) }}">Modifica</a>
                                <form action="{{route('admin.categories.destroy', $category->id)}}" class="d-inline-block delete-post" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger mx-2" type="submit">DELETE</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        
@endsection