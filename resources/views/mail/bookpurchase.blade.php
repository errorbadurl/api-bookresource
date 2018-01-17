<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>API Book Resource - Purchase</title>
        <!-- Bootstrap -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
        </style>
    </head>
    <body style="background-color: #fff">
        <div class="fluid-container">
            <h1 class="text-success">Purchase Successful</h1>
            <div class="col-lg-12">
                <h4>Puchase Summary :</h4>
                <ul>
                    <li>Customer Name : {{$user->first_name}} {{$user->last_name}}</li>
                    <li>Customer Email : {{$user->email}}</li>
                    <li>Book Title : {{$book->title}}</li>
                    <li>Book Author : {{$book->author_first_name}} {{$book->author_last_name}}</li>
                    <li>Book Price : ${{round($book->price,2)}}</li>
                    <li>Quantity : {{$quantity}}</li>
                </ul>
            </div>
            <h3 class="text-danger"><i>Thank you for your purchase!</i></h3>
        </div>
    </body>
</html>