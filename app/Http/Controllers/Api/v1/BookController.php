<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\BookNotBelongsToUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Requests\PurchaseRequest;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Model\Book;
use App\Model\Purchase;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

/**
 * @resource Book
 */
class BookController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api')->except('index, search');
    }

    /**
     * Book List
     *
     * Displays all books with details.
     *
     * @method GET
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BookCollection::collection(Book::paginate(10));
    }

    /**
     * Book View
     *
     * Displays the selected book's details.
     *
     * @method GET
     * @param  \App\Model\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Book Create
     *
     * Store a newly created book in storage.
     *
     * @method POST
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
     * Book Update
     *
     * Update the specified book in storage.
     *
     * @method PUT|PATCH
     * @param  \App\Http\Requests\BookRequest  $request
     * @param  \App\Model\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, Book $book)
    {
        $this->BookUserCheck($book);

        $book->update($request->all());
        return response([
            'data' => new BookCollection($book)
        ], Response::HTTP_OK);
    }

    /**
     * Book Delete
     *
     * Soft deletes the specified book. It can be viewed through the history.
     *
     * @method DELETE
     * @param  \App\Model\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)   
    {
        $this->BookUserCheck($book);

        $book->delete();
        return response([
            'message' => 'Book deleted'
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
