<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Common\CommonAuth;
use App\Http\Common\CommonBegin;

class CommonController extends Controller
{
    public $request;
    public $commonAuth;
    public $commonBegin;
    

    public function __construct(Request $request){

        session()->regenerate();
        
        $this->request = $request;
        $this->commonAuth = new CommonAuth;
        $this->commonBegin = new CommonBegin;
	}

}
