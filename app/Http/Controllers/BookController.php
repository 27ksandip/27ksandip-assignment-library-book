<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookCreateRequest;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::orderBy('created_at', 'DESC')->with('author')->paginate(2);
        
        return $books->toResourceCollection();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookCreateRequest $bookCreateRequest)
    {
        $book = $bookCreateRequest->validated();
        Book::create($book);

        return response()->json($book, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id);

        return response()->json($book->toResource(), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookCreateRequest $bookCreateRequest, string $id)
    {
        $validatedData = $bookCreateRequest->validated();
        $book = Book::findOrFail($id);
        $book->update($validatedData);

        return response()->json($book, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);
        $book->delete();

        return response()->json(['message' => 'Book deleted successfully.'], 200);
    }
}
