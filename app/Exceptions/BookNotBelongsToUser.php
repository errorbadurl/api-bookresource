<?php

namespace App\Exceptions;

use Exception;

class BookNotBelongsToUser extends Exception
{
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return ['data' => 'Book Not Belongs To User'];
    }
}
