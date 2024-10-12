@extends('layouts.app')

@section('title', 'Add New Book')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4">Add New Book</h1>

            <!-- Display Success Message -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            

            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label">Book Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Book Description <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Price -->
                <div class="mb-3">
                    <label for="price" class="form-label">Price ($)</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div class="mb-3">
                    <label for="image" class="form-label">Book Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- PDF Upload -->
                <div class="mb-3">
                    <label for="pdf" class="form-label">Book PDF</label>
                    <input type="file" class="form-control" id="pdf" name="pdf" accept="application/pdf">
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
                            <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
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
                    <input type="date" class="form-control" id="published_at" name="published_at" value="{{ old('published_at') }}" >
                    @error('published_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Add Book</button>
            </form>
        </div>
    </div>
@endsection
