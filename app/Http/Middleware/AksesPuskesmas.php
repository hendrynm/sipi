<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AksesPuskesmas
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(session()->has("id_puskesmas"))
        {
            return $next($request);
        }
        session()->flash("gagal","Anda tidak berhak mengakses halaman ini!");
        return redirect("/");
    }
}
