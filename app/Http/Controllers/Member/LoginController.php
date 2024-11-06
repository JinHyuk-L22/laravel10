<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Member\LoginServices;

class LoginController extends Controller{

    private $loginServices;

    public function __construct(){

        // $this->middleware('guest')
        //     ->except([
        //         'logout',
        //     ]);

        $this->loginServices = new LoginServices();

        $viewData = [
            'main_key'  => 'member',
            // 'memberConfig' => config('site.member')
        ];

        view()->share($viewData);
    }

    public function login(Request $request){

        $viewData = [
            'sub_key' => 'login'
        ];

        view()->share($viewData);

        // return view('member.login');
        
        return $request->isMethod('post')
            ? $this->loginServices->loginService($request)
            : view('member.login');
    }

    public function logout(Request $request){
        return $this->loginServices->logoutService($request);
    }

    public function test(Request $request){

        $viewData = [
            'sub_key' => 'login'
        ];

        view()->share($viewData);

        return view('member.test');
    }
}
