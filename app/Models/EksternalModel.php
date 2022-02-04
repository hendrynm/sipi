<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EksternalModel extends Model
{
    public function daftarKampung($id_kab)
    {
        return DB::table("kampung")
            ->join("puskesmas","kampung.id_puskesmas","=","puskesmas.id_puskesmas")
            ->where("id_kabupaten","=",$id_kab)
            ->orderBy("nama_kampung")
            ->select("id_kampung","nama_kampung")
            ->get();
    }

    public function daftarPosyandu($id_kab)
    {
        return DB::table("posyandu")
            ->join("kampung","posyandu.id_kampung","=","kampung.id_kampung")
            ->join("puskesmas","kampung.id_puskesmas","=","puskesmas.id_puskesmas")
            ->where("id_kabupaten","=",$id_kab)
            ->orderBy("nama_posyandu")
            ->select("id_posyandu","nama_posyandu")
            ->get();
    }

    public function dataDashboardKirim(Request $request)
    {
        return DB::table("data_individu")
            ->join("kampung","data_individu.id_kampung","=","kampung.id_kampung")
            ->join("puskesmas","kampung.id_puskesmas","=","puskesmas.id_puskesmas")
            ->join("kabupaten","puskesmas.id_kabupaten","=","kabupaten.id_kabupaten")
            ->where("nama_lengkap","=",$request->nama)
            ->orWhere("nik","=",$request->nik)
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
        $kueri = DB::table("data_individu")
            ->insert([
                "nama_lengkap" => $request->namaLengkap,
                "nama_ibu" => $request->namaIbuKandung,
                "nik" => $request->nik,
                "tanggal_lahir" => $request->tanggalLahir,
                "jenis_kelamin" => $request->jenisKelamin,
                "no_hp" => $request->noHP,
                "alamat" => $request->alamat,
                "id_posyandu" => $request->posyandu,
                "id_kampung" => $request->kampung,
                "status_hamil" => $request->isHamil ?: null,
                "tanggal_hamil" => $request->tanggalKehamilan ?: null
            ]);
        if($kueri > 0)
        {
            $id = DB::table("data_individu")
                ->orderByDesc("id_anak")
                ->first();
            $data = DB::table("antigen")
                ->get();

            foreach ($data as $d)
            {
                DB::table("imunisasi")
                    ->insert([
                        "id_anak" => $id->id_anak,
                        "id_antigen" => $d->id_antigen,
                        "status" => "belum"
                    ]);
            }
            return $id;
        }
        return 0;
    }

    public function posMulai(Request $request)
    {
        return DB::table("data_individu")
            ->join("imunisasi","data_individu.id_anak","=","imunisasi.id_anak")
            ->join("antigen","imunisasi.id_antigen","=","antigen.id_antigen")
            ->where("nama_lengkap","=",$request->nama)
            ->orWhere("nik","=",$request->nik)
            ->where("status","=","belum")
            ->groupBy("data_individu.id_anak")
            ->select("data_individu.id_anak","nik","nama_lengkap","nama_ibu","tanggal_lahir",DB::raw("GROUP_CONCAT(antigen.nama_antigen SEPARATOR ', ') as nama_antigen"))
            ->get();
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
