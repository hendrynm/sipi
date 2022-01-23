<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AksesKabupaten
{
    public function handle(Request $request, Closure $next)
    {
        if(session()->has("id_kabupaten"))
        {
            return $next($request);
        }
        session()->flash("gagal","Anda tidak berhak mengakses halaman ini!");
        return redirect("/");
    }
}
