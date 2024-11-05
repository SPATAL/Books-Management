@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Author: {{ $author->name }}</h1>

    <form action="{{ route('authors.update', $author->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="form-group mb-3">
            <label for="name">Name<span class="text-danger">*</span></label>
            <input type="text" name="name" value="{{ old('name', $author->name) }}" class="form-control" >
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Bio -->
        <div class="form-group mb-3">
            <label for="bio">Bio</label>
            <textarea name="bio" class="form-control">{{ old('bio', $author->bio) }}</textarea>
            @error('bio')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Current Picture -->
        @if($author->picture)
            <div class="form-group mb-3">
                <label>Current Picture:</label>
                <div>
                    <img src="{{ asset('authors/' . $author->picture) }}" alt="{{ $author->name }}" width="100">
                </div>
            </div>
        @endif

        <!-- Picture -->
        <div class="form-group mb-3">
            <label for="picture">Change Picture</label>
            <input type="file" name="picture" class="form-control">
            @error('picture')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">Update Author</button>
        <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
