<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BlockIp
{

    public $ip_list = [
        '127.0.0.1'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        /* if(in_array($request->getClientIp(), $this->ip_list)) {
            abort(403, 'Unauthorized action.');
        } */

        $ip_list = DB::table('ip_blocks')->get();

        foreach ($ip_list as $ip) {
            if ($request->ip() == $ip->ip_address) {
                abort(403, $ip->reason);
            }
        }
        
        return $next($request);
    }
}
