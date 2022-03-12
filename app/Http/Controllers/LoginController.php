<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends CommonController
{

    public function index() {
        if ($this->commonAuth->isLogin()) {
            return redirect('/map/map');
        }
        return view('login.login');
    }

    public function login() {
        session(['login' => true]);
        return redirect('map/map');
    }

    public function logout() {
        session()->forget('login');
        return redirect('login');
    }
}
