<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has('lang') && in_array($request->query('lang'), ['ar', 'en'])) {
            $locale = $request->query('lang');
            session(['locale' => $locale]);
        } else {
            $locale = session('locale', config('app.locale', 'ar'));
        }

        if (!in_array($locale, ['ar', 'en'])) {
            $locale = 'ar';
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
