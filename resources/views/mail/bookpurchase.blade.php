<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>API Book Resource - Purchase</title>
    </head>
    <body style="background-color:#fff;font-family:'Raleway',sans-serif;width:100%">
        <div style="padding:10px;">
            <h1 style="font-family:'Raleway',sans-serif;font-size:32px;">Purchase Successful</h1>
            <div>
                <h2 style="color:#4caf50;font-weight:100;font-family:'Raleway',sans-serif;font-size:25px;margin-bottom:0px;margin-top:0px;padding:0 20px;">Puchase Summary :</h2>
                <ul style="line-height:3;">
                    <li>Customer Name : {{$user->first_name}} {{$user->last_name}}</li>
                    <li>Customer Email : {{$user->email}}</li>
                    <li>Book Title : {{$book->title}}</li>
                    <li>Book Author : {{$book->author_first_name}} {{$book->author_last_name}}</li>
                    <li>Book Price : ${{round($book->price,2)}}</li>
                    <li>Quantity : {{$quantity}}</li>
                </ul>
            </div>
            <h2 style="color:#f44336;font-family:'Raleway',sans-serif;font-size:25px;font-style:italic;font-weight:700;">Thank you for your purchase!</h2>
        </div>
    </body>
</html>