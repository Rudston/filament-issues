<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiCustom
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
        // custom api logic from VLE
        // based on secret key + md5 of passed timestamp
        // on production, timestamp cannot be older than 30 seconds

        $headers = getallheaders();
        if (!isset($headers['Apirequesttime'])) {
            // return response('No APIREQUESTTIME header was received');
            return response('Unauthenticated');
        }
        if (!isset($headers['Apisignature'])) {
            // return response('No APISIGNATURE header was received');
            return response('Unauthenticated');
        }

        $api_key = env('API_KEY');
        $api_auth = $headers['Apisignature'];
        $api_request_time = (int) $headers['Apirequesttime'];
        $_auth = md5($api_key.$api_request_time);

        // on production only:
        // only allow calls to be 10 seconds old or 10 seconds in the future
        $env = env('APP_ENV', 'production');
        if (($env == 'production') && ($api_request_time < time()-10) || ($api_request_time > time()+10)) {
            // return response('Timestamp is too old');
            return response('Unauthenticated');
        }

        if ($_auth != $api_auth) {
            // return response('API Key not valid');
            return response('Unauthenticated');
        }

        return $next($request);
    }
}
