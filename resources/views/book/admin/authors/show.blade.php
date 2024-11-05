@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Author Information -->
    <div class="card mb-4">
        <div class="card-header">
            <strong>The Author Details :</strong> 
        </div>
        <div class="row card-body">
            <!-- Picture -->
            <div class="col-md-3">
            @if($author->picture)
                <img src="{{ asset('authors/'.$author->picture) }}" alt="{{ $author->name }}" class="img-thumbnail mb-3" style="width: 150px;">
            @endif
            </div>

            <div class="col-md-4">
                    <h3 class="mb-4 card-title">{{ $author->name }}</h3>
                    <hr class="w-100 my-4 border-2 border-secondary">

                    <p class="card-text">{{ $author->bio }}</p>
            </div>
        </div>
    </div>

    <!-- Author's Books -->
    <div class="card">
        <div class="card-header">
        <strong>Books By {{ $author->name }}</strong>
        </div>
        <div class="card-body">
            @if($author->books->isEmpty())
                <p>No books found for this author.</p>
            @else
                <ul class="list-group">
                    @foreach($author->books as $book)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $book->title }}
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm">View</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="mt-3">
        <a href="{{ route('authors.edit', $author->slug) }}" class="btn btn-warning">Edit Author</a>
        <a href="{{ route('authors.index') }}" class="btn btn-secondary">Back to Authors</a>
    </div>
</div>
@endsection
