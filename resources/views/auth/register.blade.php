<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Register - API Book Resource</title>
    </head>
    <body>
        <form method="POST" action="/api/register">
            {!! csrf_field() !!}

            <div>
                Name
                <input type="text" name="name" value="{{ old('name') }}">
            </div>

            <div>
                Email
                <input type="email" name="email" value="{{ old('email') }}">
            </div>

            <div>
                Password
                <input type="password" name="password">
            </div>

            <div>
                Confirm Password
                <input type="password" name="password_confirmation">
            </div>

            <div>
                <button type="submit">Register</button>
            </div>
        </form>
    </body>
</html>