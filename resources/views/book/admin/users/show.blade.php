@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Details: {{ $user->name }}</h1>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
            <p><strong>Registered At:</strong> {{ $user->created_at->format('Y-m-d') }}</p>
        </div>
    </div>

    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit User</a>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users</a>
</div>
@endsection
