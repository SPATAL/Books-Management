@extends('layouts.app')

@section('title', 'Books List')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Books List</h1>

            <!-- Display Success Message -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('books.create') }}" class="btn btn-success mb-3">Add New Book</a>

            @if($books->isEmpty())
                <p>No books available.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Price ($)</th>
                                <th>Author ID</th>
                                <th>Published At</th>
                                <th>Image</th>
                                <th>PDF</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ Str::limit($book->description, 100) }}</td>
                                    <td>{{ number_format($book->price, 2) }}</td>
                                    <td>{{ $book->author_id }}</td>
                                    <td>{{ $book->published_at ? $book->published_at->format('Y-m-d') : 'N/A' }}</td>
                                    <td>
                                        @if($book->image)
                                            <img src="{{ asset('images/' . $book->image) }}" alt="{{ $book->title }}" width="100">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if($book->pdf)
                                            <a href="{{ asset('pdfs/' . $book->pdf) }}" class="btn btn-primary btn-sm" target="_blank">View PDF</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('books.show', $book->slug) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('books.edit', $book->slug) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('books.destroy', $book->slug) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <div class="d-flex justify-content-center">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>
    </div>
</div>
@endsection
