<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Route;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $hasNoPermissions = false;

    public function __construct(Request $request)
    {
        if ( $request->header('hasNoPermissions') ) {
            $this->hasNoPermissions = true;
        }
        $this->middleware(function ($request, $next) {
            if (request()->is('*dashboard*') && !request()->is('*api*') && !str_contains(Route::currentRouteName(), 'home')) {
                if(auth()->check()) {
                    $routeName = Route::currentRouteName();
                    $routeName = substr($routeName, 6);
                    $routeName = preg_replace('/\bstore\b/u', 'create', $routeName);
                    $routeName = preg_replace('/\bupdate\b/u', 'edit', $routeName);
                    if(! $this->hasNoPermissions && !str_contains($routeName, 'notifications')
                            && !str_contains($routeName, 'pdf')
                            && !str_contains($routeName, 'orders.sendPDF')
                            && !str_contains($routeName, 'orders.update')
                            && !str_contains($routeName, 'orders.edit')
                            && !str_contains($routeName, 'profile')
                            && !str_contains($routeName, 'change_password')
                            && !str_contains($routeName, 'abouts.index')
                            && !str_contains($routeName, 'abouts.create')
                            && !str_contains($routeName, 'abouts.store')
                            && !str_contains($routeName, 'abouts.edit')
                            && !str_contains($routeName, 'abouts.update')
                            && !str_contains($routeName, 'abouts.destroy')
                            && !str_contains($routeName, 'terms.index')
                            && !str_contains($routeName, 'terms.store')
                            && !str_contains($routeName, 'terms.edit')
                            && !str_contains($routeName, 'terms.create')
                            && !str_contains($routeName, 'terms.update')
                            && !str_contains($routeName, 'terms.destroy')
                            && !auth()->user()->hasAnyPermission($routeName)) {
                        return abort(403, 'Unauthorized action');
                    }
                }
            }
            return $next($request);
        })->except('logout');
    }
}
