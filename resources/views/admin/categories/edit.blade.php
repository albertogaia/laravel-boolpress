@extends('layouts.dashboard')
@section('title', "Modifica categoria: $category->name")

@section('content')
<div class="container">
    <div class="content">
        <div class="row">
            <div class="col-12">
                <form action="{{route('admin.categories.update', $category->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="name">Inserisci il nome della categoria che vuoi creare</label>
                        <input type="text" name="name" class="form-control" autofocus>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">MODIFICA CATEGORIA</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection