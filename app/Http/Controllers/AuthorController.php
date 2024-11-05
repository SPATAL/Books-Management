<?php
namespace App\Http\Controllers;

use Illuminate\Support\Str;
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
    public function store(Request $request){

    $request->validate([
        'name' => 'required|string|max:255|unique:authors,name', // Ensure names are unique for slug purposes
        'bio' => 'nullable|string',
        'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $slug = Str::slug($request->name);

    $data = $request->only(['name', 'bio']);
    $data['slug'] = $slug; // Add the generated slug

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
    public function show($slug){

        $author = Author::where('slug', $slug)->firstOrFail();
        $author->load('books'); // Eager load books
        return view('book.admin.authors.show', compact('author'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug){

        $author = Author::where('slug', $slug)->firstOrFail();
        return view('book.admin.authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $author = Author::where('slug', $slug)->firstOrFail();

        $request->validate([
            'name' => 'nullable|string|max:255|unique:authors,name,',
            'bio' => 'nullable|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('picture')) {
            if ($author->picture && file_exists(public_path('authors/' . $author->picture))) {
                unlink(public_path('authors/' . $author->picture));
            }
    
            $filename = time() . '-' . $request->file('picture')->getClientOriginalName();
            $request->file('picture')->move(public_path('authors'), $filename);
            $author->picture = $filename;   
        }

        $slug = Str::slug($request->name);
        $author->name = $request->name;
        $author->bio = $request->bio;
        $author->slug = $slug;
        $author->save();
    
        return redirect()->route('authors.index')->with('success', 'Author updated successfully.');
    }
    


    /**
     * Remove the specified author from storage.
     */
    public function destroy($slug)
    {
        $author = Author::where('slug', $slug)->firstOrFail();
        if ($author->picture && file_exists(public_path('authors/' . $author->picture))) {
            unlink(public_path('authors/' . $author->picture));
        }


        $author->delete();

        return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
    }
}
