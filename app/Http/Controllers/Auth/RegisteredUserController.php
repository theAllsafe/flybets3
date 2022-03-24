<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('myAuth.register');
//        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255', 'regex:/^[A-za-z ]+$/'],
            'last_name' => ['required', 'string', 'max:255', 'regex:/^[A-za-z ]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'unique:organisations'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
//            'password' => Hash::make($request->password),
            'password' => $request->password,
        ]);

        event(new Registered($user));

        return redirect()->back()->with('success', [
            'title' => 'Sign Up Complete',
            'content' => 'You have been successfully signed up as a new user.'
        ]);
    }
}
