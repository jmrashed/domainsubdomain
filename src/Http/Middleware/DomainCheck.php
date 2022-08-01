<?php

namespace Jmrashed\DomainSubdomain\Http\Middleware;

use Closure;
use Illuminate\Support\Str;

class DomainCheck
{
    public function handle($request, Closure $next)
    {
        if ($request->has('domain')) {
            $request->merge([
                'domain' => Str::lower($request->domain)
            ]);
        }
        return $next($request);
    }
}
