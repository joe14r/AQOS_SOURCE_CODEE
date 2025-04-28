<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Al Madinah Restaurant</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
</head>

<body>
    <header>
        <h1>Admin Login</h1>
    </header>
    <main>
            <form method="POST" action="{{ route('login') }}">
                        @csrf
            <label for="email">Email:</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            <label for="password">Password:</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
        </form>
    </main>
    <script src="{{ asset('/assets/js/script.js')}}"></script>
</body>

</html>

