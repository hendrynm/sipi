<?php

namespace App\Http\Controllers;

use App\Models\LoginModel;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view("umum.login");
    }

    public function login(Request $request)
    {
        LoginModel::login($request);

        switch(session()->get("akses"))
        {
            case (1):
                return redirect("/provinsi");
            case (2):
                return redirect("/kabupaten");
            case (3):
                return redirect("posyandu");
            default:
                return redirect("/");
        }
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
