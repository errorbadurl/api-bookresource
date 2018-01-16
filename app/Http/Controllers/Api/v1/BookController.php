<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\BookNotBelongsToUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Model\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
        $book = new Book($request->all());
        $request->user()->books()->save($book);
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
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function history_show(Request $request)
    {
        $book = $request->user()->books()->onlyTrashed()->where('id', $request->book)->get()->first();

        $this->BookUserCheck($book);

        return new BookCollection($book);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request)
    {
        $this->BookUserCheck($request->user()->books()->onlyTrashed()->where('id', $request->book)->get()->first());

        $request->user()->books()->onlyTrashed()->where('id', $request->book)->restore();
        return response([
            'data' => new BookCollection($request->user()->books()->where('id', $request->book)->get()->first())
        ], Response::HTTP_OK);
    }

    /**
     * Check if book belongs to user.
     *
     * @param  \App\Model\Book  $book
     * @return \App\Exceptions\BookNotBelongsToUser
     */
    protected function BookUserCheck($book)
    {
        if (Gate::denies('auth-check', $book)) {
            throw new BookNotBelongsToUser;
        }
    }
}
