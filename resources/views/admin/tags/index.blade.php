@extends('layouts.dashboard')
@section('title', 'All categories')
@section('content')
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
                <div class="btn btn-success"><a class="text-reset" href="{{route('admin.tags.create')}}">Nuovo Tag</a></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col"># ID</th>
                    <th scope="col">Nome tag</th>
                    <th scope="col">N° Posts</th>
                    <th class="text-center" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr>
                            <th scope="row">{{$tag->id}}</th>
                            <td><a href="{{ route('admin.tags.show', $tag->id) }}">{{$tag->name}}</a></td>
                            <td><a href="{{ route('admin.tags.show', $tag->id) }}">{{count($tag->posts)}}</a></td>
                            <td class="text-center">
                                <a class="mx-2 text-reset btn btn-success" href="{{ route('admin.tags.show', $tag->id) }}">Visualizza</a>

                                {{-- Da creare Funzione Destroy --}}
                                <form action="{{route('admin.tags.destroy', $tag->id)}}" class="d-inline-block delete-tag" method="POST">
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