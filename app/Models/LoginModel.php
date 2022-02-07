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
        if(!is_null($user) && (Hash::check($password, $user->password))) {
            $request->session()->put("id_user",$user->id_user);
            $request->session()->put("level",$user->level);
            switch($user->level)
            {
                case(2):
                    $request->session()->put("id_kabupaten",$user->id_kabupaten);
                    $request->session()->put("is_kab","true");
                    break;
                case(3):
                    $request->session()->put("id_kabupaten",$user->id_kabupaten);
                    $request->session()->put("id_puskesmas",$user->id_puskesmas);
                    $request->session()->put("is_pus","true");
                    break;
                case(4):
                    $request->session()->put("id_kabupaten",$user->id_kabupaten);
                    $request->session()->put("is_eks","true");
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
