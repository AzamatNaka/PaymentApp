<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $client = auth()->user();

        return view('client.cabinet', compact('client'));
    }
    public function createClient()
    {
        return view('auth.client_login');
    }
    public function loginClient(Request $request)
    {
        if(Auth::check()){
            return redirect()->intended('client/cabinet'); //intended куда хотел изначално
        }

        $validated = $request->validate([
            'phone' => ['required', 'string', 'phone:KZ'],
            'password' => ['required', 'string'],
        ]);

        if(Auth::attempt($validated)) { //attempt базадан тексереди validatedтеги данный бар ма деп иа болса логин кылып киргизеди
            return redirect()->route('client.index');
        }

        return back()->withErrors('Incorrect email or password');
    }
}
