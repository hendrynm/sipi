<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginModel extends Model
{
    public function login(Request $request): bool
    {
        $username = $request->username;
        $password = $request->password;

        $user = DB::table("user")->where("username","=",$username)->first();
        if(($user !== null) && Hash::check($password, $user->password)) {
            $level = DB::table("level")->where("id_level","=",$user->id_level)->first();

            $request->session()->flash("sukses","Selamat Datang " . $user->nama . "!");
            $request->session()->put("id",$user->id_user);
            $request->session()->put("akses",$level->level);
            return true;
        }
        $request->session()->flash("gagal","Username atau Password yang Anda masukkan salah");
        return false;
    }
}
