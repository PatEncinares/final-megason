<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Megason Diagnostic Clinic - OTP Verification</title>
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

        .otp-card {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 420px;
        }

        .otp-logo {
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

        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 1rem 0;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    @include('sweetalert::alert')

    <div class="otp-card">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Megason Logo" class="otp-logo">

        <form method="POST" action="{{ route('validate-otp') }}">
            @csrf

            @if($errors->any())
                <div class="text-danger text-center mb-3">{{ $errors->first() }}</div>
            @endif

            <div class="form-group">
                <label for="otp">Enter OTP</label>
                <input type="text" name="otp" id="otp" class="form-control" required autofocus placeholder="Enter OTP" />
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>

            <div class="text-center mt-3">
                <a href="{{ route('new-otp') }}" class="small">Request new OTP</a>
            </div>
        </form>
    </div>

    <footer class="text-center">
        <small class="text-muted">&copy; Megason Diagnostic Clinic 2021</small>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
