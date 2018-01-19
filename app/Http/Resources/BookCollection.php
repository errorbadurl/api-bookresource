<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class BookCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $href = [ 'link' => route('books.show', $this->id) ];
        if ($this->deleted_at) {
            $href = [
                'link' => route('books.history.show', $this->id),
                'link_restore' => route('books.history.restore', $this->id)
            ];
        }
        return [
            'title' => $this->title,
            'author' => trim($this->author_first_name." ".$this->author_last_name),
            'price' => $this->price,
            'stock' => $this->stock,
            'href' => $href,
        ];
    }
}
