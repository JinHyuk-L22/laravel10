<?php

namespace App\Http\Middleware\Site;

use Illuminate\Support\Facades\Auth;
use Closure;

class BbsPermission{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){

        $bbs_name = $request->route()->parameter('bbs_name');

        $viewData = [
            'bbs_name'          => $bbs_name,
            'bbsConfig'         => config('site.bbs.'.$bbs_name),
            'bbsParams'         => config('site.bbs.params'),
            'main_key'          => config('site.bbs.' . $bbs_name . '.main_key'),
            'sub_key'           => config('site.bbs.' . $bbs_name . '.sub_key'),
        ];

        view()->share($viewData);

        $call_method = $request->route()->getActionMethod();
        $bbs_permission = config('site.bbs.' . $bbs_name. '.permission');

        if( !isAdmin() ){
            if ( !$bbs_permission[$call_method]() ) {
                return authRedirect()->with('alert', '회원 전용 메뉴입니다.');
            }
        }

        return $next($request);

    }
}
