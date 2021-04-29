<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dealer;
use Session;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function loginAct(Request $r){
        $r->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $check = Dealer::query()
                    ->where('username', $r->username)
                    ->where('password', md5($r->password))
                    ->first();
        
        if($check){
            Session::put('logged_in', 'done');
            return redirect()->route('car-list');
        }

        return redirect()->back()->withErrors('Wrong credentials');
    }

    public function logout(){
        Session::forget('logged_in');
        Session::save();

        return redirect()->route('login');
    }
}
