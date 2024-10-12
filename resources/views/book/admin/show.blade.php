@extends('layouts.app')

@section('content')

<div class="container">

    <!-- Book Details Card -->
    <div class="card mb-4">
        <div class="card-header">
            {{ $book->title }}
        </div>
        <div class="card-body">
            <!-- Display Book Image -->
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('images/'.$book->image) }}" alt="{{ $book->title }}" class="img-fluid" style="max-width: 250px; height: auto;">
                </div>
                <div class="col-md-8">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <p class="card-text">{{ $book->description }}</p>
                </div>

                <h3>Author</h3>
                <p>{{ $book->author->name }}</p>
                <a href="{{ route('authors.show', $book->author->id) }}" class="btn btn-info btn-sm">View Author</a>


                <div class="col-md-2">
                    <p class="card-text"><strong>Price:</strong> ${{ $book->price }}</p>
                    <p><strong>Published Date:</strong> 
                            {{ $book->published_at ? $book->published_at->format('Y-m-d') : 'N/A' }}
                    </p>                
                </div>
            </div>
        </div>
    </div>

    <!-- PDF Viewer Card -->
    <div class="card">
        <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="card-header accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    PDF Viewer
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <iframe src="{{ asset('pdfs/'.$book->pdf) }}" width="100%" height="500px" style="max-width: 600px; border: 1px solid #ddd;">
                        This browser does not support PDFs. Please download the PDF to view it: 
                        <a href="{{ asset('pdfs/'.$book->pdf) }}">Download PDF</a>.
                    </iframe>
                </div>
            </div>
        </div>
    </div>

        <div class="card-footer">
            <!-- Button to download PDF -->
            <a href="{{ asset('pdfs/'.$book->pdf) }}" class="btn btn-primary" download>Download PDF</a>
        </div>
        <div class="card-footer">
            <!-- Back to Book List -->
            <a href="{{ route('books.index') }}" class="btn btn-secondary">Back to List</a>

            <!-- Edit Button -->
            <a href="{{ route('books.edit', $book->slug) }}" class="btn btn-primary">Edit Book</a>

            <!-- Delete Button -->
            <form action="{{ route('books.destroy', $book->slug) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this book?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete Book</button>
            </form>
        </div>
    </div>
</div>
@endsection
