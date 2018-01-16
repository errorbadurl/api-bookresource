<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class BookResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'decription' => $this->description,
            'author' => trim($this->author_first_name." ".$this->author_last_name),
            'price' => $this->price,
            'stock' => $this->stock,
            // 'href' => [
            //     'user' => route('user.books.show', $this->user->id)
            // ],
        ];
    }
}
