<?php

namespace App\Http\Controllers\Auth2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create(){
        return view('auth.login');
    }

    public function login(Request $request){
        if(Auth::check()){
            return redirect()->route('admin.clientOrBusiness');
        }

        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if(Auth::attempt($validated)) { //attempt базадан тексереди validatedтеги данный бар ма деп иа болса логин кылып киргизеди
            if(Auth::user()->hasRole("super-user")){
                return redirect()->route('admin.user_list');
            }
            elseif(Auth::user()->hasRole("business")){
                return redirect()->route('business.index');
            }
//            return redirect()->route('client.index');
        }

        return back()->withErrors('Incorrect email or password');
    }


    public function logout(){
        Auth::logout();
        return redirect()->route('client.index');
    }
}
