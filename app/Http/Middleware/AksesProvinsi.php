<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AksesProvinsi
{
    public function handle(Request $request, Closure $next)
    {
        if(session()->get("level") === 1)
        {
            return $next($request);
        }
        session()->flash("gagal","Anda tidak berhak mengakses halaman ini!");
        return redirect("/");
    }
}
