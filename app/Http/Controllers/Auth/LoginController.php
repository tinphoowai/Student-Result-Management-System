<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Email;

class LoginController extends Controller
{
    //
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login (Request $request){
        $credentials = $request->validate([
            'email'=> 'required|email',
            'password'=>'required|string',
        ]);
        $remember = $request->boolean('remember');

        if (Auth::guard('admin')->attempt($credentials,$remember)){
            $request->session()->regenerate();
            return redirect()->route('admin.index')->with('success','Login successfully');
        } elseif (Auth::guard('student')->attempt($credentials,$remember)) {
            $request->session()->regenerate();
            return redirect()->route('students.index')->with('success','Login successfully');
        } else {
            return back()->withErrors(['The provided credential do not match our record'])->onlyInput('email');
        }
    }
}
