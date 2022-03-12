<?php

namespace App\Http\Common;

class CommonAuth
{
    public function isLogin(){
        if (!session()->has('login') or session('login') != true) {
            return false;
        }
        return true;
	}
}
