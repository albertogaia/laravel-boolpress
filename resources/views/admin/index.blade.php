@extends('layouts.dashboard')
@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Welcome back, {{Auth::user()->name}}</h2>
            <p>Oggi è il {{date('d-m-Y')}} e sono le {{date('H:i')}}</p>
        </div>
    </div>
</div>
@endsection
