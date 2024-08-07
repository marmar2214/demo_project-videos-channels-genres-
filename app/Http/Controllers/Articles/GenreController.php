<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Video;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $query = Genre::query();

        if ($search) {
            $query->where('name', 'like', '%'.$search.'%')
                  ->orWhere('name_mm', 'like', '%'.$search.'%');
        }
        $genres = $query->paginate(5);


        return view('pages.genres.index', compact('genres', 'search'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_mm' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $genre = Genre::create($validated);
        $genre->save();
        return redirect()->route('genres.index')->with('msg', 'Genre created successfully.');
    }

    public function edit($id)
    {
        $genre = Genre::findOrFail($id);
        return view('pages.genres.edit', compact('genre'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_mm' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $genre = Genre::findOrFail($id);
        $genre->update($request->all());

        return redirect()->route('genres.index')->with('msg', 'Genre updated successfully.');
    }

    public function destroy(int $id)
    {
        Genre::findOrFail($id)->delete();
        return redirect()->route('genres.index')->with('msg', 'Genre Deleted Successfully!');
    }

}
