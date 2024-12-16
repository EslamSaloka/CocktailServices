<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Support\API;

class DashboardAuthenticateSuspend
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(\Auth::check()) {
            if(in_array(\App\Models\User::TYPE_CUSTOMER,\Auth::user()->roles()->pluck("name")->toArray())) {
                if(request()->is("*dashboard*")) {
                    return redirect()->route("home.index")->with("danger","لا يوجد لديك صلاحيات بالتواجد هنا");
                }
            }
            if(\Auth::user()->suspend == 1)  {
                \Auth::logout();
                return redirect()->back();
            }
        }
        return $next($request);
    }
}
