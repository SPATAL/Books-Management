@extends('layouts.app')

@section('content')
<div class="container">
<h1 class="mt-4">Edit Book: {{ $book->title }}</h1>
<!-- Display Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    

    <form action="{{ route('books.update', $book->slug) }}" enctype="multipart/form-data" method="POST" class="mt-3">
        @csrf
        @method('PUT')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4">Add New Book</h1>

            



                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label">Book Title *</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $book->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description *</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description', $book->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Price -->
                <div class="mb-3">
                    <label for="price" class="form-label">Price ($) *</label>
                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $book->price) }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <label for="image" class="form-label">Image URL *</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image', $book->image) }}" accept="image/*" >
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- PDF -->
                <div class="mb-3">
                    <label for="pdf" class="form-label">PDF URL *</label>
                    <input type="file" class="form-control @error('pdf') is-invalid @enderror" id="pdf" name="pdf" value="{{ old('pdf', $book->pdf) }}" accept="application/pdf" >
                    @error('pdf')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Author Selection -->
        <div class="form-group mb-3">
            <label for="author_id">Author<span class="text-danger">*</span></label>
            <select name="author_id" class="form-control" required>
                <option value="">-- Select Author --</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
            @error('author_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

                <!-- Published At -->
                <div class="mb-3">
                    <label for="published_at" class="form-label">Published At</label>
                    <input type="date" class="form-control @error('published_at') is-invalid @enderror" id="published_at" name="published_at" value="{{ old('published_at', $book->published_at ? $book->published_at->format('Y-m-d') : '') }}">
                    @error('published_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary">Add Book</button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>

            </form>
        </div>
    </div>
@endsection


