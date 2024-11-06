<?php

namespace App\Http\Middleware\Site;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ViewShareMenu{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next){

        view()->share([
            'menu' => $request->routeIs('admin.*') ? config('stie.adminMenu') : config('site.menu'),
            'carbon' => new Carbon()
        ]);

        return $next($request);
    }
}
