<?php

namespace App\Http\Controllers;

use App\Mail\BookPurchaseMail;
use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
    public function send()
    {
        Mail::to('egrubellano@gmail.com')->send(new BookPurchaseMail([], [], 1));
    }
}
