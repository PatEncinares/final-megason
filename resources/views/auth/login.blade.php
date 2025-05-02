{{-- <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Megason Diagnostic Clinic</title>
        <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication" style="background-color: #32CD32!important;">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container" style="margin-top: 45px!important;">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    

                                    <img src="{{asset('assets/img/logo.png')}}" alt="" class="img-responsive">
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('signin') }}" aria-label="{{ __('Login') }}">
                                            @csrf
                                            @if($errors->any())
                                                <center><h6 style="color: red">{{$errors->first()}}</h6></center>
                                            @endif
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4 {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus id="inputEmailAddress" type="email" placeholder="Enter email address" />
                                                
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4 {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required id="inputPassword" type="password" placeholder="Enter password" />
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                                                <button type="submit" class="btn btn-primary">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="{{ route('register') }}">Need an account? Sign up!</a></div>
                                    </div>
                                    <div class="card-footer text-center">
                                    <div class="small"><a href="{{ url('/') }}">Return to HOME</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Megason Diagnostic Clinic 2021</div>
                            <div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
    </body>
</html>
 --}}


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

