<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Megason Diagnostic Clinic') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #4CAF50, #2E8B57);
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                        Megason
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <!-- <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a> -->
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4" style="background: linear-gradient(135deg, #4CAF50, #2E8B57);">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header"><h3>{{ __('Patient Registation') }}</h3></div>
            
                            <div class="card-body">
                                <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                                    @csrf
            
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
            
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
            
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
            
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        </div>
                                    </div>
            
                                    <hr>
            
                                    <h3>Personal Information</h3>
            
                                    <div class="form-group row">
                                        <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="mobile" type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ old('mobile') }}" required autofocus>
                                            <small>Note: (include country code! e.g +639351234567) Please input a valid and active contact number, your OTP will be sent on this number.</small>
                                            @if ($errors->has('mobile'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('mobile') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>
            
                                        <div class="col-md-6">
                                          <input id="dob" name="dob" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" type="date" value="{{ old('dob') }}">
                                        </div>
            
                                        @if ($errors->has('dob'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('dob') }}</strong>
                                            </span>
                                        @endif
            
                                    </div>
            
                                    <div class="form-group row">
                                        <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
            
                                        <div class="col-md-6">
                                            <select name="gender" id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="{{ old('gender') }}" required autofocus>
                                                <option value="" disabled>-- Select gender --</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
            
                                            @if ($errors->has('gender'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('gender') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="civil_status" class="col-md-4 col-form-label text-md-right">{{ __('Civil Status') }}</label>
            
                                        <div class="col-md-6">
                                            <select name="civil_status" id="civil_status" class="form-control{{ $errors->has('civil_status') ? ' is-invalid' : '' }}" name="gender" value="{{ old('gender') }}" required autofocus>
                                                <option value="" disabled>-- Select Civil Status --</option>
                                                <option value="single">Single</option>
                                                <option value="married">Married</option>
                                                <option value="widowed">Widowed</option>
                                                <option value="separated">Separated</option>
                                            </select>
            
                                            @if ($errors->has('gender'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('gender') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="age" type="number" class="form-control{{ $errors->has('age') ? ' is-invalid' : '' }}" name="age" value="{{ old('age') }}" readonly autofocus>
            
                                            @if ($errors->has('age'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('age') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required autofocus>
            
                                            @if ($errors->has('address'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        <label for="weight" class="col-md-4 col-form-label text-md-right">{{ __('Weight (kg)') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="weight" type="number" class="form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}" name="weight" value="{{ old('weight') }}" required autofocus>
            
                                            @if ($errors->has('weight'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('weight') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        <label for="height" class="col-md-4 col-form-label text-md-right">{{ __('Height (cm)') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="height" type="number" class="form-control{{ $errors->has('height') ? ' is-invalid' : '' }}" name="height" value="{{ old('height') }}" required autofocus>
            
                                            @if ($errors->has('height'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('height') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            
                                    <hr>
            
                                    <h3>Emergency Contact</h3>
            
                                    <div class="form-group row">
                                        <label for="emergency_name" class="col-md-4 col-form-label text-md-right">{{ __('Emergency Contact Name') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="emergency_name" type="text" class="form-control{{ $errors->has('emergency_name') ? ' is-invalid' : '' }}" name="emergency_name" value="{{ old('emergency_name') }}" required autofocus>
            
                                            @if ($errors->has('emergency_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('emergency_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        <label for="emergency_number" class="col-md-4 col-form-label text-md-right">{{ __('Emergency Contact Number') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="emergency_number" type="text" class="form-control{{ $errors->has('emergency_number') ? ' is-invalid' : '' }}" name="emergency_number" value="{{ old('emergency_number') }}" required autofocus>
                                            <small>Note: (include country code! e.g +639351234567) Please input a valid and active contact number, your OTP will be sent on this number.</small>
                                            @if ($errors->has('emergency_number'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('emergency_number') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        <label for="emergency_address" class="col-md-4 col-form-label text-md-right">{{ __('Emergency Contact Address') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="emergency_address" type="text" class="form-control{{ $errors->has('emergency_address') ? ' is-invalid' : '' }}" name="emergency_address" value="{{ old('emergency_address') }}" required autofocus>
            
                                            @if ($errors->has('emergency_address'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('emergency_address') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
            
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dobInput = document.getElementById("dob");
        const ageInput = document.getElementById("age");

        dobInput.addEventListener("change", function() {
            if (dobInput.value) {
                const dob = new Date(dobInput.value);
                const today = new Date();
                let age = today.getFullYear() - dob.getFullYear();
                const monthDiff = today.getMonth() - dob.getMonth();
                
                // Adjust age if the birthday hasn't occurred yet this year
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                    age--;
                }

                ageInput.value = age; // Set the calculated age
            }
        });
    });
</script>

