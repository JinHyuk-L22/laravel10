<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller{
    public function __construct(){
        view()->share([
            'main_key' => 'main',
            'is_main' => true
        ]);
    }


    public function index(Request $request){

        // return json_encode( ['msg' => 'test'] );

        return view('welcome');
    }


}
