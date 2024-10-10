@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Admin Dashboard</h1>
    
    <!-- Statistics Cards -->
    <div class="row">
        <!-- Total Users -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $userCount }}</h5>
                    <p class="card-text">Number of registered users.</p>
                </div>
            </div>
        </div>
        
        <!-- Total Books -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Books</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $bookCount }}</h5>
                    <p class="card-text">Number of books in the database.</p>
                </div>
            </div>
        </div>
        
        <!-- Additional Statistics Cards can be added here -->
    </div>
    
    <!-- Recent Users -->
    <div class="card mb-4">
        <div class="card-header">
            Recent Users
        </div>
        <div class="card-body">
            @if($recentUsers->isEmpty())
                <p>No users found.</p>
            @else
                <ul class="list-group">
                    @foreach($recentUsers as $user)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $user->name }}
                            <span>
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    
    <!-- Recent Books -->
    <div class="card mb-4">
        <div class="card-header">
            Recent Books
        </div>
        <div class="card-body">
            @if($recentBooks->isEmpty())
                <p>No books found.</p>
            @else
                <ul class="list-group">
                    @foreach($recentBooks as $book)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $book->title }}
                            <span>
                                <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    
    <!-- Add more sections as needed -->
</div>
@endsection
