<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::withCount('books')->paginate(10);
        return view('book.admin.authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book.admin.authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name','bio']);

        // $slug= Str::slug($request->title,'-');
        // //set image Name and move it to images folder
        // $newImageName = uniqid().'-'.$slug.'.'.$request->image->extension();
        // $request->image->move(public_path('images'), $newImageName);

        if ($request->hasFile('picture')) {
            $filename = time() . '_' . $request->file('picture')->getClientOriginalName();
            $request->file('picture')->move(public_path('authors'), $filename);
            $data['picture'] = $filename;
        }

        Author::create($data);

        return redirect()->route('authors.index')->with('success', 'Author created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        $author->load('books'); // Eager load books
        return view('book.admin.authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        return view('book.admin.authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $author = Author::findOrFail($id);

        // Update the book's attributes
        $author->name = $request->name;
        $author->bio = $request->bio;
        $author->picture = $request->picture;



        // Check if a new picture is uploaded
        if ($request->hasFile('picture')) {
            if ($author->picture && file_exists(public_path($author->picture))) {
                unlink(public_path($author->picture));
            }
            $filename = time() . '-' . $request->file('picture')->getClientOriginalName();
            $request->file('picture')->move(public_path('authors'), $filename);
            $author->picture = $filename;   
        }

        $author->save();

            



        return redirect()->route('authors.index')->with('success', 'Author updated successfully.');
    }

    /**
     * Remove the specified author from storage.
     */
    public function destroy(Author $author)
    {
        if ($author->picture && file_exists(public_path('authors/' . $author->picture))) {
            unlink(public_path('authors/' . $author->picture));
        }

        $author->delete();

        return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
    }
}
