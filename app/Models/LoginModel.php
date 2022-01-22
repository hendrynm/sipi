<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginModel extends Model
{
    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $user = DB::table("user")->where("username","=",$username)->first();
        if(Hash::check($password, $user->password)) {
            $level = DB::table("level")->where("id_level","=",$user->id_level)->first();

            $request->session()->flash("sukses","Selamat Datang " . $user->nama . "!");
            $request->session()->put("id_user",$user->id_user);
            $request->session()->put("akses",$level->level);
            switch($level->level)
            {
                case(2):
                    $request->session()->put("id_kabupaten",$user->id_kabupaten);
                    break;
                case(3):
                    $request->session()->put("id_puskesmas",$user->id_puskesmas);
                    break;
                default:
                    break;
            }
            return true;
        }
        $request->session()->flash("gagal","Username atau Password yang Anda masukkan salah");
        return false;
    }
}
