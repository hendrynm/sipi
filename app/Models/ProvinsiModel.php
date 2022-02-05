<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProvinsiModel extends Model
{
    public function daftarKabupaten()
    {
        return DB::table("kabupaten")
            ->orderBy("nama_kabupaten")
            ->select("id_kabupaten","nama_kabupaten")
            ->get();
    }

    public function daftarPuskesmas()
    {
        return DB::table("puskesmas")
            ->orderBy("nama_puskesmas")
            ->select("id_puskesmas","nama_puskesmas")
            ->get();
    }

    public function daftarKampung()
    {
        return DB::table("kampung")
            ->orderBy("nama_kampung")
            ->select("id_kampung","nama_kampung")
            ->get();
    }

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
        return DB::table("antigen")
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
        $tambah = DB::table("antigen")
            ->insert([
            "nama_antigen" => $request->namaAntigen,
            "waktu_pemberian" => $request->waktuPemberian,
            "interval_pemberian" => $request->intervalPemberian,
            "target_tahunan" => $request->targetTahunan
        ]);
        if(count($tambah) > 0)
        {
            $id = DB::table("antigen")
                ->orderByDesc("id_antigen")
                ->first();
            $kueri = DB::table("data_individu")
                ->select("id_anak")
                ->get();
            foreach($kueri as $k)
            {
                DB::table("imunisasi")
                    ->insert([
                        "id_anak" => $k->id_anak,
                        "id_antigen" => $id->id_antigen,
                        "status" => "belum"
                    ]);
            }
            return 1;
        }
        return 0;
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
        $kueri1 = DB::table("user")
            ->where("id_user","=",$request->idUser)
            ->update([
                "username" => $request->username,
                "nama" => $request->nama,
                "email" => $request->email,
            ]);
        if(count($kueri1) > 0)
        {
            $kueri2 = DB::table("level")
                ->where("id_level","=",$request->idLevel)
                ->update(["level" => $request->level]);
            if(count($kueri2) > 0)
            {
                return 1;
            }
        }
        return 0;
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
            (Hash::check($request->passwordLama,$user->password)) &&
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

    public function akunTambahKirim(Request $request)
    {
        if($request->password === $request->password2)
        {
            DB::table("level")
                ->insert([
                    "level" => $request->level,
                    "nama_level" => $request->nama
                ]);
            $kueri = DB::table("level")
                ->orderByDesc("id_level")
                ->first();
            DB::table("user")
                ->insert([
                    "nama" => $request->nama,
                    "username" => $request->username,
                    "email" => $request->email,
                    "password" => Hash::make($request->password),
                    "id_level" => $kueri->id_level
                ]);
            return 1;
        }
        return 0;
    }

    public function akunHapusKirim($id)
    {
        $kueri = DB::table("user")
            ->where("id_user","=",$id)
            ->select("id_level")
            ->first();
        DB::table("user")
            ->where("id_user","=",$id)
            ->delete();
        DB::table("level")
            ->where("id_level","=",$kueri->id_level)
            ->delete();
    }

    public function kampungDashboard()
    {
        return DB::table("kampung")
            ->join("puskesmas","kampung.id_puskesmas","=","puskesmas.id_puskesmas")
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
                "kode_kampung" => $request->kodeRegion,
                "id_puskesmas" => $request->puskesmas
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
        return DB::table("posyandu")
            ->where("id_posyandu","=",$request->idPosyandu)
            ->update([
                "nama_posyandu" => $request->namaPosyandu,
                "alamat_posyandu" => $request->alamatLengkap
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

    public function kabupatenDashboard()
    {
        return DB::table("kabupaten")
            ->get();
    }

    public function kabupatenEdit($id)
    {
        return DB::table("kabupaten")
            ->where("id_kabupaten","=",$id)
            ->first();
    }

    public function kabupatenEditKirim(Request $request)
    {
        return DB::table("kabupaten")
            ->where("id_kabupaten","=",$request->idKabupaten)
            ->update([
                "kode_kabupaten" => $request->kodeRegional,
                "nama_kabupaten" => $request->namaKabupaten
            ]);
    }

    public function kabupatenTambahKirim(Request $request)
    {
        return DB::table("kabupaten")
            ->insert([
                "kode_kabupaten" => $request->kodeRegional,
                "nama_kabupaten" => $request->namaKabupaten
            ]);
    }

    public function puskesmasDashboard()
    {
        return DB::table("puskesmas")
            ->join("kabupaten","puskesmas.id_kabupaten","=","kabupaten.id_kabupaten")
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
                "nama_puskesmas" => $request->namaPuskesmas,
                "id_kabupaten" => $request->kabupaten
            ]);
    }

    public function puskesmasTambahKirim(Request $request)
    {
        return DB::table("puskesmas")
            ->insert([
                "kode_puskesmas" => $request->kodePuskesmas,
                "nama_puskesmas" => $request->namaPuskesmas,
                "id_kabupaten" => $request->kabupaten
            ]);
    }

    public function sasaranDashboard()
    {
        return DB::table("kampung")
            ->select("id_kampung","kode_kampung","nama_kampung")
            ->get();
    }

    public function sasaranTarget($id)
    {
        return DB::table("kampung")
            ->where("id_kampung","=",$id)
            ->first();
    }
}
