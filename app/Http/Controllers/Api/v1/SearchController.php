<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookSearchRequest;
use App\Http\Resources\BookCollection;
use App\Model\Book;
use DB;
use Illuminate\Http\Request;

/**
 * @resource Search
 */
class SearchController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    /**
     * Book Search
     *
     * Search the database for a desired book.
     *
     * @method GET
     * @param  \App\Http\Requests\BookSearchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function bookSearch(BookSearchRequest $request)
    {
        // Start query
        $query = Book::orderBy('title', 'asc');
        // Check if id exists
        $id = $request->id;
        if ($id && !empty($id)) { // If yes, search with id
            $query->where('id', 'like', "%{$id}%");
        }
        // Check if keyword exists
        $keyword = $request->keyword;
        if ($keyword && !empty($keyword)) { // If yes, search with ketword
            $query->where(function($query) use ($keyword) {
                $query->orWhere('title', 'like', "%{$keyword}%");
                $query->orWhere('description', 'like', "%{$keyword}%");
            });
        }
        // Check if author name exists
        $author = $request->author;
        if ($author && !empty($author)) { // If yes, search with author name
            $query->where(function($query) use ($author) {
                $query->orWhere(DB::raw("CONCAT(`author_first_name`, ' ', `author_last_name`)"), 'like', "%{$author}%");
                $query->orWhere('author_first_name', 'like', "%{$author}%");
                $query->orWhere('author_last_name', 'like', "%{$author}%");
            });
        }
        // Check if price exists
        $price = $request->price;
        if ($price && !empty($price)) { // If yes, search with price
            $query->where('price', '=', "{$price}");
        }
        // Make the query and load the data
        $result = $query->paginate(10);

        return BookCollection::collection($result);
    }
}
