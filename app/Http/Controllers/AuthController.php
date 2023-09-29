<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EmailVerification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{


    public function index()
    {
        return view('auth.auth');
    }
    public function check(Request $request)
    {
        $request->validate([
            'email' => 'string|email|required|max:100|',
        ]);
        $registered = User::where('email', $request->email)->first();
        $email = $request->email;
        if (!$registered) {
            return to_route('register_user', compact('email'));
        } else {
            return to_route('login_user', compact('email'));
        }
    }
    public function login()
    {
        return view('auth.login');
    }
    public function register()
    {
        return view('auth.register');
    }
    public function register_save(Request $request)
    {

        $request->validate([
            'name' => 'string|required|min:2',
            'email' => 'string|email|required|max:100|unique:users',
            'phone' => 'numeric|digits:11',
            'password' => 'string|required|confirmed|min:6'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();
        $this->sendOtp($user);
        return redirect("/verification/" . $user->id);
    }

    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'string|required|email',
            'password' => 'string|required'
        ]);

        $userCredential = $request->only('email', 'password');
        $userData = User::where('email', $request->email)->first();
        if ($userData && $userData->is_verified == 0) {
            $this->sendOtp($userData);
            return redirect("/verification/" . $userData->id);
        } else if (Auth::attempt($userCredential)) {
            Auth::user()->update(['online_at' => now()]);
            return redirect('/dashboard');
        } else {
            return back()->with('error', 'Username & Password is incorrect');
        }
    }


    public function sendOtp($user)
    {
        $otp = rand(100000, 999999);
        $time = time();

        EmailVerification::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'when_created' => $time,
                'otp' => $otp,
                'user_id' => $user->id

            ]
        );

        $data['email'] = $user->email;
        $data['title'] = 'Mail Verification';

        $data['body'] = 'Your OTP is:- ' . $otp;

        Mail::send('auth.mailVerification', ['data' => $data], function ($message) use ($data) {
            $message->to($data['email'])->subject($data['title']);
        });
    }

    public function loadDashboard()
    {
        if (Auth::user()) {
            return view('auth.dashboard');
        }
        return redirect('/');
    }

    public function verification($id)
    {
        $user = User::where('id', $id)->first();
        if (!$user || $user->is_verified == 1) {
            return redirect('/');
        }
        $email = $user->email;
        return view('auth.otp', compact('email'));
    }

    public function verifiedOtp(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $otpData = EmailVerification::where('otp', $request->otp)->first();
        if (!$otpData) {
            return back()->with('message', 'You entered wrong OTP');
        } else {
            $currentTime = time();
            $otpCreationTime = $otpData->when_created;
            $otpExpiryTime = $otpCreationTime + 3600;
            if ($currentTime <= $otpExpiryTime) { //60 minutes
                User::where('id', $user->id)->update([
                    'is_verified' => 1
                ]);

                return to_route("login_user")->with('message', 'OTP Verified, login with your details');
            } else {
                return back()->with('message', 'OTP Expired');
            }
        }
    }

    public function resendOtp($email)
    {
        $user = User::where('email', $email)->first();
        $otpData = EmailVerification::where('email', $email)->first();
        $currentTime = time();
        $time = $otpData->when_created;
        if ($currentTime >= $time && $time >= $currentTime - (90 + 5)) { //90 seconds
            return back()->with('message', 'Please try again sometime');
        } else {
            $this->sendOtp($user); //OTP SEND
            return back()->with('message', 'OTP has been sent');
        }
    }
    public function logout(Request $request)
    {
        Auth::user()->update(['online_at' => null]);
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'You have been logged out!');
    }
}
