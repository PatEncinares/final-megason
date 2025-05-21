<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Megason Diagnostic Clinic</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        body {
            background: linear-gradient(135deg, #4CAF50, #2E8B57);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 420px;
        }

        .login-logo {
            display: block;
            max-width: 200px;
            margin: 0 auto 20px;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-primary {
            width: 100%;
            border-radius: 8px;
        }

        .small a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Megason Logo" class="login-logo">
        <form method="POST" action="{{ route('signin') }}">
            @csrf
            @if($errors->any())
                <div class="text-danger text-center mb-3">{{ $errors->first() }}</div>
            @endif
            <div class="form-group">
                <label for="inputEmailAddress">Email</label>
                <input type="email" id="inputEmailAddress" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Enter email address" />
                @if ($errors->has('email'))
                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" id="inputPassword" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" required placeholder="Enter password" />
                @if ($errors->has('password'))
                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                @endif
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="rememberPasswordCheck" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="rememberPasswordCheck">Remember password</label>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Login</button>
            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('password.request') }}" class="small">Forgot Password?</a>
                <a href="{{ url('/') }}" class="small">Return to HOME</a>
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('register') }}" class="small">Need an account? Sign up!</a>
            </div>
        </form>
    </div>
</body>
</html>

