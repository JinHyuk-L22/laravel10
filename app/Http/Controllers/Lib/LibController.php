<?php

namespace App\Http\Controllers\Lib;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Executive;

class LibController extends Controller{

    public function __construct(){

        $viewData = [
            'main_key'  => 'member',
            // 'memberConfig' => config('site.member')
        ];

        view()->share($viewData);
    }

    public function rowspan(Request $request){

        $executive = Executive::orderBy('order_num', 'asc')->get();

        $viewData = [
            'executive' => $executive,
            'sub_key'   => 'login'
        ];

        view()->share($viewData);

        return view('lib.rowspan');
    }
}
