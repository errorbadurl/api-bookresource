<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PurchaseCollection extends Resource
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
            'customer' => [
                'name' => $this->user->first_name." ".$this->user->last_name,
                'email' => $this->user->email,
            ],
            'quantity' => $this->quantity,
            'seller' => [
                'name' => $this->book->user->first_name." ".$this->book->user->last_name,
                'email' => $this->book->user->email,
            ],
        ];
    }
}
