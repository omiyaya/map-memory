<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Files;
use App\Http\Common\Common;

class MapController extends CommonController
{
    public function index() {
        if (!$this->commonAuth->isLogin()) {
            return redirect('login');
        }
        $post = $this->request->input();
        $map = config('map');
        return view('map.map', compact('post', 'map'));
    }


}
