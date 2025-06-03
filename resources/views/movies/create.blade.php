@extends('layouts.main')
@section('title', 'Create Movie')
@section('navMovie', 'active')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded-4 border-0">
        <div class="card-header bg-dark text-white rounded-top-4">
            <h4 class="mb-0">Create Movie</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('movie.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Title --}}
                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Synopsis --}}
                <div class="mb-3">
                    <label for="synopsis" class="form-label fw-semibold">Synopsis</label>
                    <textarea class="form-control @error('synopsis') is-invalid @enderror" id="synopsis" name="synopsis" rows="4">{{ old('synopsis') }}</textarea>
                    @error('synopsis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Category --}}
                <div class="mb-3">
                    <label for="category_id" class="form-label fw-semibold">Category</label>
                    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Year --}}
                <div class="mb-3">
                    <label for="year" class="form-label fw-semibold">Year</label>
                    <input type="number" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ old('year') }}" required>
                    @error('year') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Actors --}}
                <div class="mb-3">
                    <label for="actors" class="form-label fw-semibold">Actors</label>
                    <input type="text" class="form-control @error('actors') is-invalid @enderror" id="actors" name="actors" value="{{ old('actors') }}">
                    @error('actors') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Cover Image --}}
                <div class="mb-3">
                    <label for="cover_image" class="form-label fw-semibold">Cover Image</label>
                    <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image" accept="image/*">
                    @error('cover_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Buttons --}}
                <button type="submit" class="btn btn-primary">Save Movie</button>
                <a href="{{ route('movie.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
