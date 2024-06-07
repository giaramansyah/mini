<?php

namespace App\Http\Middleware;

use App\Models\Accounts;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            return route('auth.index');
        }
    }

    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::user()) {
            $account = Accounts::find(Auth::user()->id);

            if (!$account->is_login) {
                Session::forget(['privileges', 'navigation']);
                Auth::logout();
            }
        }

        $this->authenticate($request, $guards);

        return $next($request);
    }
}
