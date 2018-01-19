<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class HistoryResource extends Resource
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
            'seller' => [
                'name' => $this->user->first_name." ".$this->user->last_name,
                'email' => $this->user->email,
            ],
            'href' => [
                'link' => route('history.show', $this->id),
                'link_restore' => route('history.restore', $this->id)
            ],
        ];
    }
}
