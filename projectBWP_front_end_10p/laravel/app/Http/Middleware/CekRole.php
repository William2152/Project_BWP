<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$bisa): Response
    {
        if (!Auth::guard("web")->check()) {
            return redirect("/loginPage");
        }

        $user = Auth::guard("web")->user();

        foreach ($bisa as $b) {
            if ($user->user_role == $b) {
                return $next($request);
            }
        }

        abort(403);
    }
}
