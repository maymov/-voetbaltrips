<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
       //
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Illuminate\Session\TokenMismatchException
     */
    public function handle($request, \Closure $next)
    {
        //disable CSRF check on following routes
        $skip = array(
            '/admin/form_validations',
            '/admin/session_timeout',
            '/admin/login'
        );

        foreach ($skip as $key => $route) {
            //skip csrf check on route
            if($request->is($route)){
                return parent::addCookieToResponse($request, $next($request));
            }
        }

        return parent::handle($request, $next);
    }
}
