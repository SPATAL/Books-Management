@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Add New Author</h1>

    <form action="{{ route('authors.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div class="form-group mb-3">
            <label for="name">Name<span class="text-danger">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Bio -->
        <div class="form-group mb-3">
            <label for="bio">Bio</label>
            <textarea name="bio" class="form-control">{{ old('bio') }}</textarea>
            @error('bio')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Picture -->
        <div class="form-group mb-3">
            <label for="picture">Picture</label>
            <input type="file" name="picture" class="form-control" accept="image/*">
            @error('picture')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">Create Author</button>
        <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
