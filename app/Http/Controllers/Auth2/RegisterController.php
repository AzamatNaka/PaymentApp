<?php

namespace App\Http\Controllers\Auth2;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Propaganistas\LaravelPhone\Rules\Phone;

class RegisterController extends Controller
{
    public function registerBusiness(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'business_name' => ['required', 'string', 'max:255'],
            'bin' => ['required', 'regex:/^\d{12}$/', 'unique:users', 'max:12'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $request->input('name'),
            'business_name' => $request->input('business_name'),
            'bin' => $request->input('bin'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ])->assignRole('business');

        return redirect()->route('admin.create_business')->with('status', 'Account Business added!!!');
    }

    public function registerClient(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'phone:KZ', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
//        dd($request->input('phone'));
        User::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
        ])->assignRole('client');

        return redirect()->route('admin.create_client')->with('status', 'Account Client added!!!');
    }


    public function create(){
        return view('auth.register');
    }

    public function register(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([ //create функциясы базага тыгады потом $user деген переменага айдиымен бирге алып шыгады
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role_id' => Role::where('name', 'user')->first()->id,
        ]);

        Auth::login($user);
        return redirect()->route('posts.index');
    }
}
