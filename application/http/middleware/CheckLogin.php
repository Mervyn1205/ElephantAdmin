<?php

namespace app\http\middleware;

class CheckLogin
{
    public function handle($request, \Closure $next)
    {
        $session = session('admin');
        if (!$session) {
            return redirect('/login');
        }

        return $next($request);
    }
}
