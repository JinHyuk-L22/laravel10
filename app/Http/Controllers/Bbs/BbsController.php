<?php

namespace App\Http\Controllers\Bbs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bbs;

class BbsController extends Controller{

    public function __construct(){
        $this->middleware('bbs.permission');
    }

    public function list( Request $request ){

        $bbs_name = $request->route()->parameter('bbs_name');
        
        // 공지
        $notice_bbss = Bbs::list( $bbs_name, 'Y', $request )->limit(5)->get();

        $bbss = Bbs::list( $bbs_name, 'N',$request )->paginate(config('site.bbs.' . $bbs_name . '.pageView'))->appends($request->query());

        $viewData = [
            'notice_bbss'   => $notice_bbss,
            'bbss'          => $bbss,
        ];

        view()->share($viewData);
        return view('bbs.' . config('site.bbs.' . $bbs_name . '.skin').'.list');
    }

    public function post( Request $request ){

        $bbs_name = $request->route()->parameter('bbs_name');

        $target = Bbs::find($request->sid) ?? new Bbs();

        $viewData = [
            'target'   => $target,
            'imsi'  => $bbs_name."_".rand(1,999999),
        ];
        view()->share($viewData);

        return view('bbs.' . config('site.bbs.' . $bbs_name . '.skin').".post");

    }
}
