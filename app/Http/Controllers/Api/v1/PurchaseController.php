<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseRequest;
use App\Http\Resources\PurchaseCollection;
use App\Mail\BookPurchaseMail;
use App\Model\Purchase;
use App\Model\Book;
use Illuminate\Http\Request;
use Mail;
use Symfony\Component\HttpFoundation\Response;

/**
 * @resource Purchase
 */
class PurchaseController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    /**
     * Book Purchase
     *
     * A customer purchases a book.
     *
     * @param  \App\Http\Requests\PurchaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function purchase(PurchaseRequest $request, Book $book)
    {
        if (($book->stock - $request->quantity) <= 0) {
            return response()->json([
                'errors' => 'Book stock is not enough'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $book->decrement('stock', $request->quantity);
        $purchase = new Purchase();
        $purchase->quantity = $request->quantity;
        $purchase->user_id = $request->user()->id;
        $purchase->book_id = $book->id;
        $purchase->save();

        // Send mail to book owner
        Mail::to($book->user->email)->send(new BookPurchaseMail($request->user(), $book, $request->quantity));

        return response([
            'data' => new PurchaseCollection($purchase)
        ], Response::HTTP_CREATED);
    }
}
