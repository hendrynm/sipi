<?php

namespace App\Http\Controllers;

use App\Models\LoginModel;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view("umum.index");
    }

    public function login(Request $request)
    {
        return (LoginModel::login($request)) ? view("umum.dash") : view("umum.index");
    }

    public function logout()
    {
        session()->flush();
        return view("umum.index");
    }
}
