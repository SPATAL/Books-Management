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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::paginate(10);
        return view('book.admin.index', compact('books'));
    }

    /**
     * Show the form for creating a new book.
     */
    public function create()
    {
        return view('book.admin.create');
    }

    /**
     * Store a newly created book in storage.
     */
    public function store(Request $request)
    {
        // Step 1: Validate the incoming request data
        $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'price'        => 'required|numeric',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
            'pdf'          => 'nullable|mimes:pdf|max:10000', // PDF validation
            //'author_id'    => 'required|integer',
            'published_at' => 'nullable|date',
        ]);

        $slug= Str::slug($request->title,'-');
        //set image Name and move it to images folder
        $newImageName = uniqid().'-'.$slug.'.'.$request->image->extension();
        $request->image->move(public_path('images'), $newImageName);
        //set pdf Name and move it to images folder
        $newPdfName = uniqid().'-'.$slug.'.'.$request->pdf->extension();
        $request->pdf->move(public_path('pdfs'), $newPdfName);

        // Step 4: Insert the book record into the database
            Book::create([
                'title'        => $request->input('title'),
                'description'  => $request->input('description'),
                'price'        => $request->input('price'),
                'image'        => $newImageName, // Assign image filename
                'pdf'          => $newPdfName,   // Assign PDF filename
                'published_at' => $request->input('published_at'),
            ]);
        

        // Step 5: Redirect to the index page with a success message
        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    // Implement other resource methods (show, edit, update, destroy) as needed

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the book by ID, or return 404 if not found
        $book = Book::findOrFail($id);
        
        // Pass the $book variable to the view
        return view('book.admin.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find the book by ID
        $book = Book::findOrFail($id); // This will throw a 404 if the book is not found
        // Pass the book to the edit view
        return view('book.admin.edit', compact('book'));    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'price'        => 'required|numeric',
            //'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
            //'pdf'          => 'nullable|mimes:pdf|max:10000', // PDF validation
            //'author_id'    => 'required|integer',
            'published_at' => 'nullable|date',
        ]);

        $book = Book::findOrFail($id);

        // Update the book's attributes
        $book->title = $request->title;
        $book->description = $request->description;
        $book->price = $request->price;
        $book->published_at = $request->published_at;

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            $book->image = $request->file('image')->store('images'); // Store the new image
        }

        // Check if a new PDF is uploaded
        if ($request->hasFile('pdf')) {
            $book->pdf = $request->file('pdf')->store('pdfs'); // Store the new PDF
        }

        $book->save(); // Save the changes to the database

        return redirect()->route('books.index')->with('success', 'Book updated successfully!'); // Redirect back with a success message
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $books = Book::findOrFail($id);
        $books->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');

    }
}
