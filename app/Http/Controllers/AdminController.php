<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function userList(){
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', '=', 'super-user');
        })
            ->orderBy('created_at')
            ->get();

        return view('admin.user_list', compact(['users']));
    }
    public function createBusiness(){
        return view('admin.create_business');
    }
    public function createClient(){
        return view('admin.create_client');
    }
    public function clientOrBusiness(){
        if(Auth::user()->hasRole("client")){
            return redirect()->route('client.index');
        }
        elseif(Auth::user()->hasRole("business")){
            return redirect()->route('business.index');
        }
        return view('auth.login');
    }
}
