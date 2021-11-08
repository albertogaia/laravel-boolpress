@extends('layouts.dashboard')
@section('title', "Crea categoria")

@section('content')
<div class="container">
    <div class="content">
        <div class="row">
            <div class="col-12">
                <form action="{{route('admin.categories.store')}}" method="POST">
                    @csrf
                    @method('POST')
                    
                    <div class="form-group">
                        <label for="name">Inserisci il nome della categoria che vuoi creare</label>
                        <input type="text" name="name" class="form-control" autofocus>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">CREA CATEGORIA</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection