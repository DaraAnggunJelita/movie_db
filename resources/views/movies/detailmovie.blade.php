@extends('layouts.main')
@section('title', 'Detail Movie')
@section('navMovie', 'active')

@section('content')
<h2>Detail Movies</h2>
<div class="card">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{$movies->cover_image}}" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{ $movies->title }}</h5>
                <p class="card-text">Synopsis:</p>
                <p class="card-text">{{$movies->synopsis}}</p>
                <p class="card-text">Actor</p>
                <p class="card-text">{{$movies->actors}}</p>
                <p class="card-text">Kategory: {{ $movies->category->category_name }}</p>
                <a href="/home" class="btn btn-success">back</a>
            </div>
        </div>
    </div>
</div>
@endsection
