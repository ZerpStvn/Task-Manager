<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    public function handle(Request $req, Closure $next)
    {
        if (!$req->user()->is_admin) {
            return response()->json(['message'=>'Forbidden'], 403);
        }
        return $next($req);
    }
}