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
    /**
     * Book Search
     *
     * Search the database for a desired book.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bookSearch(BookSearchRequest $request)
    {
        $query = Book::orderBy('title', 'asc');

        $id = $request->id;
        if ($id && !empty($id)) {
            $query->where('id', 'like', "%{$id}%");
        }

        $keyword = $request->keyword;
        if ($keyword && !empty($keyword)) {
            $query->where(function($query) use ($keyword) {
                $query->orWhere('title', 'like', "%{$keyword}%");
                $query->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        $author = $request->author;
        if ($author && !empty($author)) {
            $query->where(function($query) use ($author) {
                $query->orWhere(DB::raw("CONCAT(`author_first_name`, ' ', `author_last_name`)"), 'like', "%{$author}%");
                $query->orWhere('author_first_name', 'like', "%{$author}%");
                $query->orWhere('author_last_name', 'like', "%{$author}%");
            });
        }

        $price = $request->price;
        if ($price && !empty($price)) {
            $query->where('price', '=', "{$price}");
        }

        $result = $query->paginate(10); // make the query and load the data

        return BookCollection::collection($result);
    }
}
