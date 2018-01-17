<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PurchaseResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'book' => [
                'title' => $this->book->title,
                'author' => trim($this->book->author_first_name." ".$this->book->author_last_name),
                'price' => $this->book->price,
                'href' => [
                    'link' => route('books.show', $this->book->id)
                ],
            ],
            'quantity' => $this->quantity
        ];
    }
}
