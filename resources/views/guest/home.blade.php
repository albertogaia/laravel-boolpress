@extends('layouts.app')

@section('content')
<div class="content">
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4">Hello, Booleaners!</h1>
            <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <a class="btn btn-dark btn-lg" href="{{route('posts.index')}}" role="button">Vai Al Blog</a>
          </div>
        </div>
</div>
    
@endsection

