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
        @include('sweetalert::alert')
        <div id="layoutAuthentication" style="background-color: #32CD32!important;">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container" style="margin-top: 45px!important;">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <img src="{{asset('assets/img/logo.png')}}" alt="" class="img-responsive">
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('validate-otp') }}" aria-label="{{ __('Enter OTP') }}">
                                            @csrf
                    
                                            <div class="form-group">
                                                <label class="small mb-1" for="otp">Enter OTP:</label>
                                                <input class="form-control py-4" name="otp" required autofocus id="otp" type="text" placeholder="Enter OTP" />
                                            </div>
                                            
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="{{ route('new-otp') }}">Request new OTP</a></div>
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
</html> --}}

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
