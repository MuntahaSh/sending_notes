<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;


class RunSchedulerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next)
    {
        // نشغله مرة واحدة كل دقيقة فقط
        if (!Cache::has('scheduler_last_run')) {

            Artisan::call('app:send-scheduled-notes');

            Cache::put('scheduler_last_run', true, now()->addMinute());
        }

        return $next($request);
    }
}
