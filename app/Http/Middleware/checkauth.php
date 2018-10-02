<?php

namespace App\Http\Middleware;

use Closure;

use Cookie;
use Illuminate\Support\Facades\Crypt;

class checkauth
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
        if (Cookie::get('ticketdata') !== null) {
            $ticket = Crypt::decryptString(Cookie::get('ticketdata'));
            if(\App\USER::where('ticket', $ticket)->exists()) {
                return $next($request);
            }
            else {
                return redirect()->route('home')->with('errorcode', 7003)->withCookie(Cookie::forget('ticketdata'));
            }
        }
        else {
            return redirect()->route('home')->with('errorcode', 7003)->withCookie(Cookie::forget('ticketdata'));
        }
    }
}
