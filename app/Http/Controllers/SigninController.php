<?php

namespace App\Http\Controllers;

use App\User;
use Twilio\Rest\Client;
use App\Mail\SendOtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class SigninController extends Controller
{
    /**
     * Sends sms to user using Twilio's programmable sms client
     * @param String $message Body of sms
     * @param Number $recipients string or array of phone number of recepient
     */
  
   
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */


    private function sendMessage($message, $recipient)
    {
        // dd($recipient);
        try {
            Mail::to($recipient)->send(new SendOtpMail($message));
            \Log::info('OTP Email sent to: ' . $recipient);
        } catch (\Exception $e) {
            \Log::error('Email Error: ' . $e->getMessage());
        }
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();

        if ($user && $user->type == 3) {
            if (Auth::attempt($credentials)) {
                // Authentication passed...
                $otp = random_int(100000, 999999);
                $user = User::find(Auth::id());

                if ($user) {
                    $user->otp = $otp;
                    $user->save();

                    // Store OTP in session
                    $request->session()->put('otp', $otp);
                    $request->session()->put('otp_user_id', $user->id);

                    // Send OTP via SMS or email (if needed)
                    if ($user->contact_number) {
                        $this->sendMessage('Your OTP is ' . $otp, $user->email);
                    } else {
                        return redirect()->back()->withErrors(['No contact number found for OTP verification.']);
                    }

                    return redirect()->route('validate-otp');
                } else {
                    return redirect()->back()->withErrors(['User not found.']);
                }
            } else {
                return redirect()->back()->withErrors(['Invalid email or password.']);
            }
        } else {
            return redirect()->back()->withErrors(['You are not authorized to log in.']);
        }
    }

    // public function authenticate_staff_login(Request $request) {
    //     $credentials = $request->only('email', 'password');
    //     $user = User::where('email', $credentials['email'])->first();

    //     dd($user);

    //     if ($user && $user->type != 3) {
    //         if (Auth::attempt($credentials)) {
    //             // Authentication passed...
    //             $otp = random_int(100000, 999999);
    //             $user = User::find(Auth::id());

    //             if ($user) {
    //                 $user->otp = $otp;
    //                 $user->save();

    //                 // Store OTP in session
    //                 $request->session()->put('otp', $otp);
    //                 $request->session()->put('otp_user_id', $user->id);

    //                 // Send OTP via SMS or email (if needed)
    //                 if ($user->contact_number) {
    //                     $this->sendMessage('Your OTP is ' . $otp, $user->email);
    //                 } else {
    //                     return redirect()->back()->withErrors(['No contact number found for OTP verification.']);
    //                 }

    //                 return redirect()->route('validate-otp');
    //             } else {
    //                 return redirect()->back()->withErrors(['User not found.']);
    //             }
    //         } else {
    //             return redirect()->back()->withErrors(['Invalid email or password.']);
    //         }
    //     } else {
    //         return redirect()->back()->withErrors(['You are not authorized to log in.']);
    //     }
    // }
    public function authenticate_staff_login(Request $request) {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();

        // dd([
        //     'submitted_password' => $credentials['password'],
        //     'hashed_submitted_password' => Hash::make('test123'),
        //     'stored_hashed_password' => $user->password,
        //     'matches' => Hash::check($credentials['password'], $user->password)
        // ]);
        
    
        if (!$user) {
            return redirect()->back()->withErrors(['Email not found.']);
        }
        

        // Check manually if the password matches the hashed one
        if (!Hash::check($credentials['password'], $user->password)) {
            return redirect()->back()->withErrors(['Password does not match.']);
        }
    
        // Proceed with login
        if ($user->type != 3 && Auth::attempt($credentials)) {
            $otp = random_int(100000, 999999);
            $user = User::find(Auth::id());
    
            if ($user) {
                $user->otp = $otp;
                $user->save();
    
                $request->session()->put('otp', $otp);
                $request->session()->put('otp_user_id', $user->id);
    
                if ($user->contact_number) {
                    $this->sendMessage('Your OTP is ' . $otp, $user->email);
                } else {
                    return redirect()->back()->withErrors(['No contact number found for OTP verification.']);
                }
    
                return redirect()->route('validate-otp');
            } else {
                return redirect()->back()->withErrors(['User not found after login.']);
            }
        } else {
            return redirect()->back()->withErrors(['You are not authorized to log in or invalid credentials.']);
        }
    }
}
