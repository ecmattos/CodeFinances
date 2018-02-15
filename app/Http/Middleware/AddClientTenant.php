<?php

namespace CodeFinances\Http\Middleware;

use Closure;

class AddClientTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->is('api/*'))
        {
            $user = \Auth::guard('api')->user();

            if($user)
            {
                $client = $user->client;
                \Landlord::AddTenant($client);
            }
        }

        return $next($request);
    }
}
