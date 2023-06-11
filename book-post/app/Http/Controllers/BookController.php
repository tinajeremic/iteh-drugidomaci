<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books =Book::all();
        return new BookCollection($books);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|string|max:255',           
            'year' => 'required',
            'user_id' => 'required',
            'writer_id' => 'required',

        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $book = Book::create([
            'title' => $request->title,
            'year' => $request->year,            
            'user_id' => Auth::user()->id,
            'writer_id' => $request->writer_id,
        ]);

        return response()->json(['Book created successfully', new BookResource($book)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        if(!is_null($request->title)){
            $book->title = $request->title;
        }      
        if(!is_null($request->year)) 
        $book->year = $request->year;
        
        if(!is_null($request->writer_id)) 
        $book->writer_id = $request->writer_id;
        $book->update();
        return response()->json(['Book updated successfully', new BookResource($book)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json('Book deleted successfully');
    }
}
