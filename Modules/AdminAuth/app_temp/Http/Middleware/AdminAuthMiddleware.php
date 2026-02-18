<?php

namespace Modules\AdminAuth\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
