<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\BookNotBelongsToUser;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookCollection;
use App\Http\Resources\HistoryCollection;
use App\Http\Resources\HistoryResource;
use App\Model\Book;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

/**
 * @resource History
 */
class HistoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    /**
     * History List
     *
     * Display a listing of the deleted books.
     *
     * @resource History
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function history(Request $request)
    {
        return HistoryCollection::collection(Auth::user()->books()->onlyTrashed()->paginate(10));
    }

    /**
     * History View
     *
     * View a specified book from the history.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function historyShow(Request $request)
    {
        $book = Book::onlyTrashed()->find($request->history);

        $this->BookUserCheck($book);

        return new HistoryResource($book);
    }

    /**
     * History Restore
     *
     * Restore a specified book from the history.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request)
    {
        $book = Book::onlyTrashed()->find($request->history);

        $this->BookUserCheck($book);

        $book->restore();

        return response([
            'data' => new BookCollection($book)
        ], Response::HTTP_OK);
    }

    /**
     * History Force Delete
     *
     * Force delete the specified book from the app.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(Request $request)
    {
        $book = Book::onlyTrashed()->find($request->history);

        $this->BookUserCheck($book);

        $book->forceDelete();

        return response([
            'message' => 'Book force deleted'
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
