<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class HistoryCollection extends Resource
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
            'title' => $this->title,
            'author' => trim($this->author_first_name." ".$this->author_last_name),
            'price' => $this->price,
            'stock' => $this->stock,
            'href' => [
                'link' => route('history.show', $this->id),
                'link_restore' => route('history.restore', $this->id)
            ],
        ];
    }
}
