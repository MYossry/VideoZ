<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
   
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->Validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if(Auth::attempt($request->only('email','password'),$request->remember_token))
        {
            return redirect(route('home'));
            $request->session()->regenerate();
        }
            
        return back()->withErrors('login_faild','Wrong user name or password');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        redirect(route('dashboard'));
    }
}
