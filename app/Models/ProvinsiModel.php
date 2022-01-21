<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProvinsiModel extends Model
{
    /*
     * ANTIGEN
     */
    public function antigenDashboard()
    {
        return DB::table("antigen")
            ->get();
    }

    public function antigenEdit($id)
    {
        return DB::table("antigen")
            ->where("id_antigen","=",$id)
            ->first();
    }

    public function antigenEditKirim(Request $request)
    {
        DB::table("antigen")
            ->where("id_antigen","=",$request->idAntigen)
            ->update([
                "nama_antigen" => $request->namaAntigen,
                "waktu_pemberian" => $request->waktuPemberian,
                "interval_pemberian" => $request->intervalPemberian,
                "target_tahunan" => $request->targetTahunan
            ]);
    }

    public function antigenTambahKirim(Request $request)
    {
        DB::table("antigen")
            ->insert([
            "nama_antigen" => $request->namaAntigen,
            "waktu_pemberian" => $request->waktuPemberian,
            "interval_pemberian" => $request->intervalPemberian,
            "target_tahunan" => $request->targetTahunan
        ]);
    }

    /*
     * CAPAIAN
     */
    public function capaianKabupaten()
    {

    }

    public function capaianKampung()
    {

    }

    public function capaianProvinsi()
    {

    }

    public function capaianPuskesmas()
    {

    }

    /*
     * DATA ANAK
     */
    public function anakDashboard()
    {
        return DB::table("data_individu")
            ->join("kampung","data_individu.id_kampung","=","kampung.id_kampung")
            ->join("puskesmas","kampung.id_puskesmas","=","puskesmas.id_puskesmas")
            ->join("kabupaten","puskesmas.id_kabupaten","=","kabupaten.id_kabupaten")
            ->select("id_anak","nik","nama_lengkap","tanggal_lahir","nama_kabupaten")
            ->get();
    }

    public function anakDetail($id)
    {
        return DB::table("data_individu")
            ->join("kampung","data_individu.id_kampung","=","kampung.id_kampung")
            ->join("posyandu","data_individu.id_posyandu","=","posyandu.id_posyandu")
            ->join("puskesmas","kampung.id_puskesmas","=","puskesmas.id_puskesmas")
            ->join("kabupaten","puskesmas.id_kabupaten","=","kabupaten.id_kabupaten")
            ->where("data_individu.id_anak","=",$id)
            ->first();
    }

    public function anakDetailImunisasi($id)
    {
        return DB::table("imunisasi")
            ->join("antigen","imunisasi.id_antigen","=","antigen.id_antigen")
            ->where("id_anak","=",$id)
            ->get();
    }

    public function akunDashboard()
    {
        return DB::table("user")
            ->join("level","user.id_level","=","level.id_level")
            ->select("id_user","username","nama","email","level")
            ->get();
    }

    public function akunEdit($id)
    {
        return DB::table("user")
            ->join("level","user.id_level","=","level.id_level")
            ->where("id_user","=",$id)
            ->select("id_user","username","nama","email","user.id_level","level")
            ->first();
    }

    public function akunEditKirim(Request $request)
    {
        DB::table("user")
            ->where("id_user","=",$request->idUser)
            ->update([
                "username" => $request->username,
                "nama" => $request->nama,
                "email" => $request->email,
            ]);
        DB::table("level")
            ->where("id_level","=",$request->idLevel)
            ->update(["level" => $request->level]);
    }

    public function akunGantiPass($id)
    {
        return DB::table("user")
            ->where("id_user","=",$id)
            ->first();
    }

    public function akunGantiPassKirim(Request $request)
    {
        $user = DB::table("user")
            ->where("id_user","=",$request->idUser)
            ->first();
        if(
            (Hash::check($request->passwordLama, $user->password)) &&
            ($request->passwordBaru === $request->passwordBaru2)
        )
        {
            DB::table("user")
                ->where("id_user","=",$request->idUser)
                ->update([
                    "password" => Hash::make($request->passwordBaru),
                ]);
        }
    }

    public function akunTambahKirim(Request $request)
    {
        if($request->password === $request->password2)
        {
            DB::table("level")
                ->insert([
                    "level" => $request->level,
                    "nama_level" => "default"
                ]);
            $kueri = DB::table("level")
                ->orderByDesc("id_user")
                ->first();
            DB::table("user")
                ->insert([
                    "nama" => $request->nama,
                    "username" => $request->username,
                    "email" => $request->email,
                    "password" => Hash::make($request->password),
                    "id_level" => $kueri->id_level
                ]);
        }
    }

    public function kampungDashboard()
    {
        return DB::table("kampung")
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
        DB::table("kampung")
            ->where("id_kampung","=",$request->idKampung)
            ->update([
                "nama_kampung" => $request->namaKampung,
                "kode_kampung" => $request->kodeRegion
            ]);
    }

    public function kampungTambahKirim(Request $request)
    {
        DB::table("kampung")
            ->insert([
                "nama_kampung" => $request->namaKampung,
                "kode_kampung" => $request->kodeRegion
            ]);
    }

    public function posyanduDashboard()
    {
        return DB::table("posyandu")
            ->join("kampung","posyandu.id_kampung","=","kampung.id_kampung")
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
        DB::table("posyandu")
            ->where("id_posyandu","=",$request->idPosyandu)
            ->update([
                "nama_posyandu" => $request->namaPosyandu,
                "alamat_posyandu" => $request->alamatLengkap
            ]);
    }

    public function posyanduTambahKirim(Request $request)
    {
        DB::table("posyandu")
            ->insert([
                "nama_posyandu" => $request->namaPosyandu,
                "alamat_posyandu" => $request->alamatLengkap
            ]);
    }
}