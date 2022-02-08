<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KabupatenModel extends Model
{
    public function daftarKabupatenAll()
    {
        return DB::table("kabupaten")
            ->select("id_kabupaten","nama_kabupaten")
            ->get();
    }

    public function daftarPosyanduAll()
    {
        return DB::table("posyandu")
            ->select("id_posyandu","nama_posyandu")
            ->get();
    }

    public function daftarPuskesmas($id_kab)
    {
        return DB::table("puskesmas")
            ->where("id_kabupaten","=",$id_kab)
            ->select("id_puskesmas","nama_puskesmas")
            ->get();
    }

    public function daftarKampung($id_kab)
    {
        return DB::table("kampung")
            ->join("puskesmas","kampung.id_puskesmas","=","puskesmas.id_puskesmas")
            ->where("id_kabupaten","=",$id_kab)
            ->select("id_kampung","nama_kampung")
            ->get();
    }

    public function dashboard($id_kab)
    {
        return DB::table("kabupaten")
            ->where("id_kabupaten","=",$id_kab)
            ->select("nama_kabupaten")
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

    public function dataPindahKirim(Request $request)
    {
        return DB::table("data_individu")
            ->where("id_anak","=",$request->idAnak)
            ->update([
                "id_kampung" => $request->kampung,
                "id_posyandu" => $request->posyandu
            ]);
    }

    public function akunDashboard($id_kab)
    {
        return DB::table("user")
            ->join("kabupaten","user.id_kabupaten","=","kabupaten.id_kabupaten")
            ->where("user.id_kabupaten","=",$id_kab)
            ->select("id_user","nama_kabupaten","username","nama","email","level")
            ->get();
    }

    public function akunEdit($id)
    {
        return DB::table("user")
            ->join("kabupaten","user.id_kabupaten","=","kabupaten.id_kabupaten")
            ->where("id_user","=",$id)
            ->select("nama_kabupaten","id_user","level","username","nama","email")
            ->first();
    }

    public function akunEditKirim(Request $request, $id_kab)
    {
        return DB::table("user")
            ->where("id_user","=",$request->idUser)
            ->update([
                "username" => $request->username,
                "nama" => $request->nama,
                "email" => $request->email,
                "level" => $request->level,
                "id_kabupaten" => $id_kab,
                "id_puskesmas" => $request->idPuskesmas ?: null
            ]);
    }

    public function akunGantiPass($id)
    {
        return DB::table("user")
            ->where("id_user","=",$id)
            ->select("id_user","username","nama","email")
            ->first();
    }

    public function akunGantiPassKirim(Request $request)
    {
        $user = DB::table("user")
            ->where("id_user","=",$request->idUser)
            ->first();
        if(
            (Hash::check($request->passwordLama, $user->password)) &&
            ($request->passwordBaru == $request->passwordBaru2)
        )
        {
            DB::table("user")
                ->where("id_user","=",$request->idUser)
                ->update([
                    "password" => Hash::make($request->passwordBaru),
                ]);
            return 1;
        }
        return 0;
    }

    public function akunTambahKirim(Request $request, $id_kab)
    {
        if($request->password === $request->password2)
        {
            DB::table("user")
                ->insert([
                    "nama" => $request->nama,
                    "username" => $request->username,
                    "email" => $request->email,
                    "password" => Hash::make($request->password),
                    "level" => $request->level,
                    "id_kabupaten" => $id_kab,
                    "id_puskesmas" => $request->puskesmas ?: null
                ]);
            return 1;
        }
        return 0;
    }

    public function akunHapusKirim($id)
    {
        return DB::table("user")
            ->where("id_user","=",$id)
            ->delete();
    }

    public function kampungDashboard($id_kab)
    {
        return DB::table("kampung")
            ->join("puskesmas","kampung.id_puskesmas","=","puskesmas.id_puskesmas")
            ->where("id_kabupaten","=",$id_kab)
            ->get();
    }

    public function kampungEdit($id)
    {
        return DB::table("kampung")
            ->where("id_kampung","=",$id)
            ->first();
    }

    public function kampungEditKirim(Request $request)
    {
        return DB::table("kampung")
            ->where("id_kampung","=",$request->idKampung)
            ->update([
                "nama_kampung" => $request->namaKampung,
                "kode_kampung" => $request->kodeRegion
            ]);
    }

    public function kampungTambahKirim(Request $request)
    {
        return DB::table("kampung")
            ->insert([
                "nama_kampung" => $request->namaKampung,
                "kode_kampung" => $request->kodeRegion,
                "id_puskesmas" => $request->puskesmas
            ]);
    }

    public function posyanduDashboard($id_kab)
    {
        return DB::table("posyandu")
            ->join("kampung","posyandu.id_kampung","=","kampung.id_kampung")
            ->join("puskesmas","kampung.id_puskesmas","=","puskesmas.id_puskesmas")
            ->where("id_kabupaten","=",$id_kab)
            ->get();
    }

    public function posyanduEdit($id)
    {
        return DB::table("posyandu")
            ->join("kampung","posyandu.id_kampung","=","kampung.id_kampung")
            ->where("id_posyandu","=",$id)
            ->first();
    }

    public function posyanduEditKirim(Request $request)
    {
        return DB::table("posyandu")
            ->where("id_posyandu","=",$request->idPosyandu)
            ->update([
                "nama_posyandu" => $request->namaPosyandu,
                "alamat_posyandu" => $request->alamatLengkap,
                "id_kampung" => $request->kampung
            ]);
    }

    public function posyanduTambahKirim(Request $request)
    {
        return DB::table("posyandu")
            ->insert([
                "nama_posyandu" => $request->namaPosyandu,
                "alamat_posyandu" => $request->alamatLengkap,
                "id_kampung" => $request->kampung
            ]);
    }

    public function puskesmasDashboard($id_kab)
    {
        return DB::table("puskesmas")
            ->join("kabupaten","puskesmas.id_kabupaten","=","kabupaten.id_kabupaten")
            ->where("puskesmas.id_kabupaten","=",$id_kab)
            ->get();
    }

    public function puskesmasEdit($id)
    {
        return DB::table("puskesmas")
            ->where("id_puskesmas","=",$id)
            ->first();
    }

    public function puskesmasEditKirim(Request $request)
    {
        return DB::table("puskesmas")
            ->where("id_puskesmas","=",$request->idPuskesmas)
            ->update([
                "kode_puskesmas" => $request->kodePuskesmas,
                "nama_puskesmas" => $request->namaPuskesmas
            ]);
    }

    public function puskesmasTambahKirim(Request $request, $id_kab)
    {
        return DB::table("puskesmas")
            ->insert([
                "kode_puskesmas" => $request->kodePuskesmas,
                "nama_puskesmas" => $request->namaPuskesmas,
                "id_kabupaten" => $id_kab
            ]);
    }

    public function sasaranDashboard($id_kab)
    {
        return DB::table("kampung")
            ->join("puskesmas","kampung.id_puskesmas","=","puskesmas.id_puskesmas")
            ->where("id_kabupaten","=",$id_kab)
            ->get();
    }

    public function sasaranTarget($id)
    {
        return DB::table("kampung")
            ->where("id_kampung","=",$id)
            ->first();
    }

    public function getListKabupaten()
    {
        return DB::table("kabupaten")->select("id_kabupaten","nama_kabupaten")->get();
    }

    public function getListKabupatenById($id)
    {
        return DB::table("kabupaten")->select("id_kabupaten","nama_kabupaten")->where("id_kabupaten","=",$id)->get();
    }
}
