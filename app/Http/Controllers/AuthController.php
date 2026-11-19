<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required|max:50',
        ]);
        if(Auth::attempt($request->only('email', 'password'), $request->remember)){
            if(Auth::user()->role == 'customer') return redirect('/');
            return redirect('/dashboard');
        }
        return back()->with('failed', 'Wrong email or password!');
    }


    function register(Request $request) {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:50',
            'password' => 'required|max:50|min:8',
        ]);

        $request['status'] = "active";
        // dd($request->all());
        $user = User::create($request->all());
        Auth::login($user);
        return redirect('/');
    }

    public function logout(){
        Auth::logout(Auth::user());
        return redirect('/login');
    }


}
