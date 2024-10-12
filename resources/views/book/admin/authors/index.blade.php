@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Authors</h1>

    <a href="{{ route('authors.create') }}" class="btn btn-success mb-3">Add New Author</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($authors->isEmpty())
        <p>No authors found.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Bio</th>
                    <th>Picture</th>
                    <th>Books Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($authors as $author)
                    <tr>
                        <td>{{ $author->name }}</td>
                        <td>{{ Str::limit($author->bio, 50) }}</td>
                        <td>
                            @if($author->picture)
                                <img src="{{ asset('authors/' . $author->picture) }}" alt="{{ $author->name }}" width="50">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $author->books_count }}</td>
                        <td>
                            <a href="{{ route('authors.show', $author->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('authors.destroy', $author->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this author?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            {{ $authors->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
