<?php

namespace App\Http\Middleware;

use App\Helper\ResponseHelper;
use App\Models\General;
use Closure;
use Illuminate\Http\Request;

class VerifyApiKey
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
        $key = General::find('api_key');

        $valid = ($key && $request->header('XSRF-API-KEY') == $key->value);

        if(!$valid) {
            $response = new ResponseHelper('APIR');
            $response->setResponse(0, __('messages.error.401'), 'Invalid API Key');
            $response->getAPIResponse($request);
            return $response->jsonResponse();
        }

        return $next($request);
    }
}
