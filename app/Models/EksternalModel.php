<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EksternalModel extends Model
{
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
}
