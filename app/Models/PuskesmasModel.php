<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use function Symfony\Component\String\u;

class PuskesmasModel extends Model
{
    public function daftarPuskesmas($id_pus)
    {
        return DB::table("puskesmas")
            ->where("id_kabupaten","=",$id_pus)
            ->orderBy("nama_puskesmas")
            ->select("id_puskesmas","nama_puskesmas")
            ->get();
    }

    public function daftarKampung($id_pus)
    {
        return DB::table("kampung")
            ->where("id_puskesmas","=",$id_pus)
            ->orderBy("nama_kampung")
            ->select("id_kampung","nama_kampung")
            ->get();
    }

    public function daftarPosyandu($id_pus)
    {
        return DB::table("posyandu")
            ->join("kampung","posyandu.id_kampung","=","kampung.id_kampung")
            ->join("puskesmas","kampung.id_puskesmas","=","puskesmas.id_puskesmas")
            ->where("puskesmas.id_puskesmas","=",$id_pus)
            ->orderBy("nama_posyandu")
            ->select("id_posyandu","nama_posyandu")
            ->get();
    }

    public function dashboard($id_pus)
    {
        return DB::table("puskesmas")
            ->where("id_puskesmas","=",$id_pus)
            ->select("nama_puskesmas")
            ->first();
    }

    public function dataDashboard($id_pus)
    {
        return DB::table("data_individu")
            ->join("kampung","data_individu.id_kampung","=","kampung.id_kampung")
            ->join("puskesmas","kampung.id_puskesmas","=","puskesmas.id_puskesmas")
            ->join("kabupaten","puskesmas.id_kabupaten","=","kabupaten.id_kabupaten")
            ->where("puskesmas.id_puskesmas","=",$id_pus)
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

    public function dataEdit($id)
    {
        return DB::table("data_individu")
            ->join("kampung","data_individu.id_kampung","=","kampung.id_kampung")
            ->join("posyandu","data_individu.id_posyandu","=","posyandu.id_posyandu")
            ->join("puskesmas","kampung.id_puskesmas","=","puskesmas.id_puskesmas")
            ->join("kabupaten","puskesmas.id_kabupaten","=","kabupaten.id_kabupaten")
            ->where("data_individu.id_anak","=",$id)
            ->first();
    }

    public function dataEditKirim(Request $request)
    {
        DB::table("data_individu")
            ->where("id_anak","=",$request->idAnak)
            ->update([
                "nama_lengkap" => $request->namaLengkap,
                "nama_ibu" => $request->namaIbu,
                "nik" => $request->nik,
                "tanggal_lahir" => $request->tanggalLahir,
                "jenis_kelamin" => $request->jenisKelamin,
                "no_hp" => $request->noHP,
                "alamat" => $request->alamat,
                "id_posyandu" => $request->posyandu,
                "status_hamil" => $request->isHamil,
                "tanggal_hamil" => $request->tanggalKehamilan
            ]);
    }

    public function dataTambahKirim(Request $request)
    {
        DB::table("data_individu")
            ->where("id_anak","=",$request->idAnak)
            ->update([
                "nama_lengkap" => $request->namaLengkap,
                "nama_ibu" => $request->namaIbu,
                "nik" => $request->nik,
                "tanggal_lahir" => $request->tanggalLahir,
                "jenis_kelamin" => $request->jenisKelamin,
                "no_hp" => $request->noHP,
                "alamat" => $request->alamat,
                "id_kampung" => $request->kampung,
                "id_posyandu" => $request->posyandu,
                "status_hamil" => $request->isHamil,
                "tanggal_hamil" => $request->tanggalKehamilan
            ]);
    }

    public function akunDashboard($id_pus)
    {
        return DB::table("user")
            ->join("puskesmas","user.id_puskesmas","=","puskesmas.id_puskesmas")
            ->join("level","user.id_level","=","level.id_level")
            ->where("user.id_puskesmas","=",$id_pus)
            ->select("id_user","nama_puskesmas","username","nama","email","level")
            ->get();
    }

    public function akunEdit($id)
    {
        return DB::table("user")
            ->join("level","user.id_level","=","level.id_level")
            ->join("puskesmas","user.id_puskesmas","=","puskesmas.id_puskesmas")
            ->where("id_user","=",$id)
            ->select("nama_puskesmas","user.id_level","id_user","level","username","nama","email")
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
        }
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

    public function kampungDashboard($id_pus)
    {
        return DB::table("kampung")
            ->where("id_puskesmas","=",$id_pus)
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

    public function kampungTambahKirim(Request $request, $id_pus)
    {
        DB::table("kampung")
            ->insert([
                "nama_kampung" => $request->namaKampung,
                "kode_kampung" => $request->kodeRegion,
                "id_puskesmas" => $id_pus
            ]);
    }

    public function kampungSasaranDetail($id)
    {
        return DB::table("kampung")
            ->where("id_kampung","=",$id)
            ->first();
    }

    public function kampungSasaranUbah($id)
    {
        return DB::table("kampung")
            ->where("id_kampung","=",$id)
            ->first();
    }

    public function kampungSasaranUbahKirim(Request $request)
    {
        DB::table("kampung")
            ->where("id_kampung","=",$request->idKampung)
            ->update([
                "bayi_lahir_L" => $request->khLaki,
                "bayi_lahir_P" => $request->khPerempuan,
                "surviving_infant_L" => $request->siLaki,
                "surviving_infant_P" => $request->siPerempuan,
                "baduta_L" => $request->bdLaki,
                "baduta_P" => $request->bdPerempuan,
                "balita_L" => $request->blLaki,
                "balita_P" => $request->blPerempuan,
                "prasekolah_L" => $request->pLaki,
                "prasekolah_P" => $request->pPerempuan,
                "sd_1_L" => $request->s1Laki,
                "sd_1_P" => $request->s1Perempuan,
                "sd_2_L" => $request->s2Laki,
                "sd_2_P" => $request->s2Perempuan,
                "sd_5_L" => $request->s5Laki,
                "sd_5_P" => $request->s5Perempuan,
                "sd_6_L" => $request->s6Laki,
                "sd_6_P" => $request->s6Perempuan,
                "wusHamil" => $request->wusHamil,
                "wusTidakHamil" => $request->wusTidakHamil
            ]);
    }

    public function posyanduDashboard($id_pus)
    {
        return DB::table("posyandu")
            ->join("kampung","posyandu.id_kampung","=","kampung.id_kampung")
            ->where("id_puskesmas","=",$id_pus)
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
                "alamat_posyandu" => $request->alamatLengkap,
                "id_kampung" => $request->kampung
            ]);
    }

    public function posyanduTambahKirim(Request $request)
    {
        DB::table("posyandu")
            ->insert([
                "nama_posyandu" => $request->namaPosyandu,
                "alamat_posyandu" => $request->alamatLengkap,
                "id_kampung" => $request->kampung
            ]);
    }

    public function posBelumImunisasi($id, $id_pus)
    {
        if($id == -1)
        {
            return DB::table("data_individu")
                ->join("kampung","data_individu.id_kampung","=","kampung.id_kampung")
                ->join("imunisasi","data_individu.id_anak","=","imunisasi.id_anak")
                ->join("antigen","imunisasi.id_antigen","=","antigen.id_antigen")
                ->where("id_puskesmas","=",$id_pus)
                ->where("status","=","belum")
                ->groupBy("data_individu.id_anak")
                ->select("nama_lengkap", "tanggal_lahir", "alamat", "no_hp",DB::raw("GROUP_CONCAT(antigen.nama_antigen SEPARATOR ', ') as nama_antigen"))
                ->get();
        }
        return DB::table("data_individu")
            ->join("imunisasi","data_individu.id_anak","=","imunisasi.id_anak")
            ->join("antigen","imunisasi.id_antigen","=","antigen.id_antigen")
            ->where("id_posyandu","=",$id)
            ->where("status","=","belum")
            ->groupBy("data_individu.id_anak")
            ->select("nama_lengkap", "tanggal_lahir", "alamat", "no_hp",DB::raw("GROUP_CONCAT(antigen.nama_antigen SEPARATOR ', ') as nama_antigen"))
            ->get();
    }

    public function posMulai($id)
    {
        return DB::table("data_individu")
            ->join("imunisasi","data_individu.id_anak","=","imunisasi.id_anak")
            ->join("antigen","imunisasi.id_antigen","=","antigen.id_antigen")
            ->where("id_posyandu","=",$id)
            ->where("status","=","belum")
            ->groupBy("data_individu.id_anak")
            ->select("data_individu.id_anak","nik","nama_lengkap","nama_ibu","tanggal_lahir",DB::raw("GROUP_CONCAT(antigen.nama_antigen SEPARATOR ', ') as nama_antigen"))
            ->get();
    }

    public function getListPuskesmas()
    {
        return DB::table("puskesmas")->select("id_puskesmas","nama_puskesmas")->get();
    }

    public function posEntri($id)
    {
        return DB::table("data_individu")
            ->join("imunisasi","data_individu.id_anak","=","imunisasi.id_anak")
            ->join("antigen","imunisasi.id_antigen","=","antigen.id_antigen")
            ->where("imunisasi.id_anak","=",$id)
            ->where("status","=","belum")
            ->select("antigen.id_antigen","nama_antigen")
            ->get();
    }

    public function posEntriKirim(Request $request)
    {
        DB::table("imunisasi")
            ->where("id_anak","=",$request->idAnak)
            ->where("id_antigen","=",$request->antigen)
            ->update([
                "tanggal_pemberian" => (string)date_format(date_create($request->tanggal), "Y-m-d"),
                "tempat_imunisasi" => $request->lokasi,
                "status" => "sudah"
            ]);
    }
}
