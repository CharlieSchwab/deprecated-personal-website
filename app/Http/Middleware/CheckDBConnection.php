<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;
use Closure;

class CheckDBConnection
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
        $DB_ERROR_MSG = "Sorry, the database is down right now. No operations are available";
        
        try{
            DB::connection()->getPdo();
            return $next($request);
        }
        catch(\Exception $e){
            return back()->with('dbConnectionError', $DB_ERROR_MSG);
        }
    }
}
