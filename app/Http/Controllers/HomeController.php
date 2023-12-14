<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function login(){
        return view('login');
    }

    public function register(){
        return view('register');
    }

    

    public function login_home(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            // User found and password is correct
            // Store user information in the session
            session(['username' => $user->username, 'user_id' => $user->id, 'email' => $user->email, 'phone' => $user->phone]);
            return redirect()->route('home');
        } else {
            // User not found or password is incorrect
            session(['username' => null, 'user_id' => null]);
            return redirect()->back()->with('error', 'Incorrect email or password.');
        }
    }


    public function register_home(Request $request)
    {
        // Validate the user input
        // $request->validate([
        //     'username' => 'required|string|max:255',
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => 'required|string|min:8|confirmed',
        // ]);

        // Create a new user
        $userId = User::insertGetId([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Retrieve the created user
        $user = User::find($userId);

        // Set session data
        session(['username' => $user->username, 'user_id' => $user->id]);

        return redirect()->route('home');
    }

}
