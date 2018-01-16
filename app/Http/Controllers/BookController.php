<?php

namespace App\Http\Controllers;

use App\Exceptions\BookNotBelongsToUser;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Model\Book;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BookCollection::collection(Book::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $book = new Book();
        $book->user_id = $request->user()->id;
        $book->title = $request->title;
        $book->description = $request->description;
        $book->author_first_name = $request->author_first_name;
        $book->author_last_name = $request->author_last_name;
        $book->stock = $request->stock;
        $book->price = $request->price;
        $book->save();
        return response([
            'data' => new BookCollection($book)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $this->BookUserCheck($book);

        $book->update($request->all());
        return response([
            'data' => new BookCollection($book)
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)   
    {
        $this->BookUserCheck($book);

        $book->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function history(Request $request)
    {
        return BookCollection::collection($request->user()->books()->onlyTrashed()->paginate(10));
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request)
    {
        $request->user()->books()->onlyTrashed()->where('id', $request->book)->restore();
        return response([
            'data' => new BookCollection($request->user()->books()->where('id', $request->book)->get()->first())
        ], Response::HTTP_OK);
    }

    protected function BookUserCheck($book)
    {
        if (Auth::id() !== $book->user_id) {
            throw new BookNotBelongsToUser;
            
        }
    }
}
