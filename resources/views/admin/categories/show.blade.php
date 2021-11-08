@extends('layouts.dashboard')
@section('title', "Categoria: $category->name")

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Categoria: {{$category->name}}</h2>

            </div>
        </div>
    </div>
@endsection