<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller{

    // Redirects to the register page
    public function register() {
        return view('user.register');
    }

    // Redirects to the login page
    public function login() {
        return view('user.login');
    }

    // Redirects to the manage profile page
    public function manage_profile(Request $request) {
        return view('user.manage_profile', [
            'user' => auth()->user()
        ]);
    }

    // Adds a new user/row to the users database
    public function store(Request $request) {
        $data = $request->validate([
            'name' => ['required', 'unique:users', 'min:3', 'max:25'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'max:24'],
            'profile_picture' => ['mimes:jpeg,png', 'max:5120']
        ]);

        $data['password'] = bcrypt($data['password']);

        if($request->hasFile('profile_picture')){
            // We store profile pictures in: /storage/profile_pictures
            $data['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $user = User::create($data);

        auth()->login($user);

        return redirect('/');
    }

    // Attempts a login for a user after they've submitted login form data.
    public function attemptLogin(Request $request) {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(auth()->attempt($data)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        /* 
            In the case that the user gets the email (or password) incorrectly, 
            we bring them back to the login page with an error message. 
        */
        return back()->withErrors(['email' => 'Invalid E-mail or password', 'password' => 'Invalid E-mail or password'])->onlyInput('email');
    }

    // Logs the user out
    public function logout() {
        auth()->logout();

        // This is recommended. You should regenerate the user's csrf token once they log out.
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/');
    }
}
