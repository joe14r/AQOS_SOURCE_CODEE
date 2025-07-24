<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Al Madinah Restaurant</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
</head>
<body class="modern-admin-login-bg">
    <div class="modern-admin-login-container">
        <div class="modern-admin-login-card">
            <div class="modern-admin-login-logo">
                <i class="fas fa-utensils"></i>
            </div>
            <h2 class="modern-admin-login-title">Admin Login</h2>
            <form method="POST" action="{{ route('login') }}" class="modern-admin-login-form">
                @csrf
                <div class="modern-admin-login-form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="modern-admin-login-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="modern-admin-login-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="modern-admin-login-form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="modern-admin-login-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="modern-admin-login-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="modern-admin-login-btn">
                    <i class="fas fa-sign-in-alt"></i> {{ __('Login') }}
                </button>
            </form>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <script src="{{ asset('/assets/js/script.js')}}"></script>
</body>
</html>

