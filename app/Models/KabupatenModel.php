<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KabupatenModel extends Model
{
    public function dashboard($id_kab)
    {
        return DB::table("kabupaten")
            ->where("id_kabupaten","=",$id_kab)
            ->first();
    }

    public function dataDashboard($id_kab)
    {
        return DB::table("data_individu")
            ->join("kampung","data_individu.id_kampung","=","kampung.id_kampung")
            ->join("puskesmas","kampung.id_puskesmas","=","puskesmas.id_puskesmas")
            ->join("kabupaten","puskesmas.id_kabupaten","=","kabupaten.id_kabupaten")
            ->where("kabupaten.id_kabupaten","=",$id_kab)
            ->get();
    }

    public function dataDetail($id)
    {
        return DB::table("data_individu")
            ->join("kampung","data_individu.id_kampung","=","kampung.id_kampung")
            ->join("posyandu","data_individu.id_posyandu","=","posyandu.id_posyandu")
            ->join("puskesmas","kampung.id_puskesmas","=","puskesmas.id_puskesmas")
            ->join("kabupaten","puskesmas.id_kabupaten","=","kabupaten.id_kabupaten")
            ->where("data_individu.id_anak","=",$id)
            ->first();
    }

    public function dataDetailImunisasi($id)
    {
        return DB::table("imunisasi")
            ->join("antigen","imunisasi.id_antigen","=","antigen.id_antigen")
            ->where("id_anak","=",$id)
            ->get();
    }

    public function akunDashboard($id_kab)
    {
        return DB::table("user")
            ->join("kabupaten","user.id_kabupaten","=","kabupaten.id_kabupaten")
            ->join("level","user.id_level","=","level.id_level")
            ->where("user.id_kabupaten","=",$id_kab)
            ->select("id_user","nama_kabupaten","username","nama","email","level")
            ->get();
    }

    public function akunEdit($id)
    {
        return DB::table("user")
            ->join("level","user.id_level","=","level.id_level")
            ->where("id_user","=",$id)
            ->select("user.id_level","id_user","username","nama","email")
            ->first();
    }

    public function akunEditKirim(Request $request)
    {
        DB::table("level")
            ->where("id_level","=",$request->idLevel)
            ->update([
                "level" => $request->level
            ]);
        DB::table("user")
            ->where("id_user","=",$request->idUser)
            ->update([
                "username" => $request->username,
                "nama" => $request->nama,
                "email" => $request->email
            ]);
    }

    public function akunTambahKirim(Request $request)
    {

    }
}
