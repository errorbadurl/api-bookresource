<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login - API Book Resource</title>
    </head>
    <body>
        <form method="POST" action="/api/login">
            {!! csrf_field() !!}

            <div>
                Email
                <input type="email" name="email" value="{{ old('email') }}">
            </div>

            <div>
                Password
                <input type="password" name="password" id="password">
            </div>

            <div>
                <input type="checkbox" name="remember"> Remember Me
            </div>

            <div>
                <button type="submit">Login</button>
            </div>
        </form>
    </body>
</html>