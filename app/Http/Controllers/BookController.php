<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //lekérdezések
    public function booksFilterByUser(){
        //copies: fg neve!!!
        return Book::with('copies')
        ->get();
    }

    //2.Csoportosítsd szerzőnként a könyveket (nem példányokat) a szerzők ABC szerinti növekvő sorrendjében!
    /* public function groupBooksByAuthors()
    {
    $booksByAuthors = Author::with(['books'])
        ->orderBy('name', 'asc') 
        ->get()
        ->map(function ($author) {
            return [
                'author_name' => $author->name,
                'books' => $author->books->pluck('title'), 
            ];
        });

    return response()->json($booksByAuthors);
    } */

    //3.Határozd meg a könyvtár nyilvántartásában legalább 2 könyvvel rendelkező szerzőket!
    //public function authorsWithAtLeastTwoBooks()
    //{
    //$authors = Author::withCount('books') 
     /*    ->having('books_count', '>=', 2)
        ->orderBy('name', 'asc') 
        ->get();

    return response()->json($authors);
    } */


     
public function kettoKonyv(){
    $authors = DB::table('books')
        ->selectRaw('author, COUNT(*) book_count')
        ->groupBy('author')
        ->having('book_count', '>=', 2)
        ->orderBy('author')
        ->get();
    return $authors;
}

}
