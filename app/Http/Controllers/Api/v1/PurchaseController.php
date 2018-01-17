<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseRequest;
use App\Http\Resources\PurchaseCollection;
use App\Http\Resources\PurchaseResource;
use App\Model\Purchase;
use App\Model\Book;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PurchaseController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PurchaseCollection::collection(Purchase::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PurchaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseRequest $request)
    {
        $book = Book::find($request->book_id);
        if (($book->stock-$request->quantity) <= 0) {
            return response()->json([
                'errors' => 'Book stock is not enough'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $book->decrement('stock', $request->quantity);
        $purchase = new Purchase();
        $purchase->quantity = $request->quantity;
        $purchase->user_id = $request->user()->id;
        $purchase->book_id = $request->book_id;
        $purchase->save();
        return response([
            'data' => new PurchaseCollection($purchase)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
