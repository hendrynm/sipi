<?php

namespace App\Http\Controllers;

use App\Models\LoginModel;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        switch(session()->get("level"))
        {
            case (1):
                return redirect("/provinsi");
            case (2):
                return redirect("/kabupaten");
            case (3):
                return redirect("/puskesmas");
            case (4):
                return redirect("/eksternal");
            default:
                return view("umum.login");
        }
    }

    public function login(Request $request)
    {
        session()->flush();
        (new LoginModel)->login($request);
        return redirect("/");
    }

    public function logout()
    {
        session()->flush();
        return redirect("/");
    }

    public function lupa()
    {
        return view("umum.lupa");
    }
}
