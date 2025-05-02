<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\PatientDetail;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $now = Carbon::now()->format('m/d/Y');
        return Validator::make($data, [
            'name' => 'required|string|max:255|alpha_spaces',
            'email' => 'required|string|email|max:255|unique:users',
            // 'password' => 'required|string|min:6|confirmed',
            'password' => [
                'required',
                'string',
                'confirmed',
                'min:10',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'mobile' => 'required|numeric|regex:(^(\+)([1-9]{2})(\d{10})$)',
            'gender' => 'required',
            'age' => 'required|numeric',
            'address' => 'required|string|max:255',
            'dob' => 'before:'.$now,
            'emergency_name' => 'required|string|max:255|alpha_spaces',
            'emergency_number' => 'required|numeric|regex:(^(\+)(\d){12}$)',
            'emergency_address' => 'required|string|max:255',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'civil_status' => 'required'
        ],[
            'before' => 'Invalid date of birth',
            'password.regex'  => 'Password must contain atleast one (1) Uppercase, Lowercase, Special Character and a Number.',
            'mobile.regex' => 'Invalid phone number format, include the country code in the phone number (e.g +639123456789)',
            'emergency_number.regex' => 'Invalid phone number format, include the country code in the phone number (e.g +639123456789)',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'type' => 3,
            'contact_number' => $data['mobile'],
            'password' => Hash::make($data['password']),
        ]);

        PatientDetail::create([
            'user_id' => $user->id,
            'mobile_number' => $data['mobile'],
            'gender' => $data['gender'],
            'civil_status' => $data['civil_status'],
            'age' => $data['age'],
            'address' => $data['address'],
            'date_of_birth' => $data['dob'],
            'weight'        => $data['weight'],
            'height'        => $data['height'],
            'emergency_name' => $data['emergency_name'],
            'emergency_number' => $data['emergency_number'],
            'emergency_address' => $data['emergency_address']
        ]);

        return $user;
    }
}
