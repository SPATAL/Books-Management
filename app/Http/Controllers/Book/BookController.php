<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;


class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author')->paginate(10);
        return view('book.admin.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::orderBy('name', 'asc')->get();
        return view('book.admin.create', compact('authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:10000',
            'author_id' => 'required|exists:authors,id',
            'published_at' => 'nullable|date',
        ]);

        $slug = Str::slug($request->title, '_');
        $newImageName = $request->hasFile('image') ? uniqid().'-'.$slug.'.'.$request->image->extension() : null;
        $newPdfName = $request->hasFile('pdf') ? uniqid().'-'.$slug.'.'.$request->pdf->extension() : null;

        if ($newImageName) $request->image->move(public_path('images'), $newImageName);
        if ($newPdfName) $request->pdf->move(public_path('pdfs'), $newPdfName);

        Book::create([
            'slug' => $slug,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $newImageName,
            'pdf' => $newPdfName,
            'author_id' => $request->author_id,
            'published_at' => $request->published_at,
        ]);

        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    public function show($slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();
        return view('book.admin.show', compact('book'));
    }

    public function edit($slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();
        $authors = Author::orderBy('name', 'asc')->get();
        return view('book.admin.edit', compact('book', 'authors'));
    }

    public function update(Request $request, $slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:10000',
            'author_id' => 'required|exists:authors,id',
            'published_at' => 'nullable|date',
        ]);

        $slug = Str::slug($request->title, '_');
        $newImageName = $book->image;
        if ($request->hasFile('image')) {
            if ($book->image) unlink(public_path('images/'.$book->image));
            $newImageName = uniqid().'-'.$slug.'.'.$request->image->extension();
            $request->image->move(public_path('images'), $newImageName);
        }

        $newPdfName = $book->pdf;
        if ($request->hasFile('pdf')) {
            if ($book->pdf) unlink(public_path('pdfs/'.$book->pdf));
            $newPdfName = uniqid().'-'.$slug.'.'.$request->pdf->extension();
            $request->pdf->move(public_path('pdfs'), $newPdfName);
        }

        $book->update([
            'slug' => $slug,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $newImageName,
            'pdf' => $newPdfName,
            'author_id' => $request->author_id,
            'published_at' => $request->published_at,
        ]);

        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }

    public function destroy($slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();
        if ($book->image && file_exists(public_path('images/' . $book->image))) {
            unlink(public_path('images/' . $book->image));
        }
    
        // Check if the PDF file exists before deleting
        if ($book->pdf && file_exists(public_path('pdfs/' . $book->pdf))) {
            unlink(public_path('pdfs/' . $book->pdf));
        }
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
