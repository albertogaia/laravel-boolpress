@extends('layouts.dashboard')
@section('title', "Modifica tag: $tag->name")

@section('content')
<div class="container">
    <div class="content">
        <div class="row">
            <div class="col-12">
                <h2>Modifica nome tag: {{$tag->name}}</h2>
                <form action="{{route('admin.tags.update', $tag->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="name">Modifica il nome del tag</label>
                        <input type="text" name="name" class="form-control" autofocus>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">MODIFICA TAG</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection