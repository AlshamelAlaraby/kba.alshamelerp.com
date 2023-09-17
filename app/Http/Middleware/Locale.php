<?php

namespace App\Http\Middleware;

use Closure;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = $request->header('accept-language', 'en');
        if (in_array($locale, config('app.available_locales')))
            config(['app.locale' => $locale]);
        return $next($request);
    }
}
