<?php

namespace App\Http\Middleware;

use App\Helper\ResponseHelper;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtAuthenticate
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
        $parameters = $request->all();

        array_walk_recursive($parameters, function (&$parameters) {
            $parameters = strip_tags($parameters);
        });

        $request->merge($parameters);

        try {
            JWTAuth::parseToken()->authenticate();
        } catch (Exception $exception) {
            $response = new ResponseHelper('APIR');
            if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                $response->setResponse(0, 'Token is Invalid');
            } else if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                $response->setResponse(0, 'Token is Expired');
            } else {
                $response->setResponse(0, 'Authorization Token not found');
            }
            $response->getAPIResponse($request);
            return $response->jsonResponse();
        }
        
        return $next($request);
    }
}
