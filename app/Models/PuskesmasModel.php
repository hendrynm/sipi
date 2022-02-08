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
    public function namaAntigen($id)
    {
        return DB::table("antigen")
            ->where("id_antigen","=",$id)
            ->first();
    }

    public function cekIDL($id)
    {
        $kueri = DB::table("imunisasi")
            ->where("id_anak", "=", $id)
            ->where("id_antigen","<=",11)
            ->get();
        $data = $kueri->toArray();
        $hasil = 1;
        for($i = 0 ; $i <= 10 ; $i++)
        {
            if($data[$i]->status === "belum" && $i !== 9)
            {
                $hasil = 0;
                break;
            }
        }
        return $hasil;
    }

    public function cekIRL($id)
    {
        $kueri = DB::table("imunisasi")
            ->where("id_anak", "=", $id)
            ->where("id_antigen",">=",12)
            ->get();
        $data = $kueri->toArray();
        $hasil = 1;
        for($i = array_key_last($data) ; $i >= 0 ; $i--)
        {
            if($data[$i]->status === "belum")
            {
                $hasil = 0;
                break;
            }
        }
        return $hasil;
    }

    public function cekT($id)
    {
        $kueri = DB::table("imunisasi")
            ->where("id_anak", "=", $id)
            ->get();
        $data = $kueri->toArray();
        $hasil = 0;
        for($i = 0 ; $i < array_key_last($data) ; $i++)
        {
            switch($i)
            {
                case(3):
                    if($data[$i]->status === "sudah")
                    {
                        $hasil = 1;
                    }
                    else
                    {
                        $hasil = 0;
                        break 2;
                    }
                    break;
                case(7):
                    if($data[$i]->status === "sudah")
                    {
                        $hasil = 2;
                    }
                    else
                    {
                        $hasil = 1;
                        break 2;
                    }
                    break;
                case(11):
                    if($data[$i]->status === "sudah")
                    {
                        $hasil = 3;
                    }
                    else
                    {
                        $hasil = 2;
                        break 2;
                    }
                    break;
                case(15):
                    if($data[$i]->status === "sudah")
                    {
                        $hasil = 4;
                    }
                    else
                    {
                        $hasil = 3;
                        break 2;
                    }
                    break;
                case(17):
                    if($data[$i]->status === "sudah")
                    {
                        $hasil = 5;
                        break 2;
                    }
                    else
                    {
                        $hasil = 4;
                        break 2;
                    }
                default:
                    continue 2;
            }
        }
        return $hasil;
    }

    public function ubahIDL($id)
    {
        $kueri = DB::table("data_individu")
            ->where("id_anak","=",$id)
            ->first();
        if($kueri->idl === 0)
        {
            DB::table("data_individu")
                ->where("id_anak","=",$id)
                ->update([
                    "idl" => 1,
                    "tanggal_idl" => (string) date_format(date_create(),"Y-m-d")
                ]);
        }
    }

    public function ubahIRL($id)
    {
        $kueri = DB::table("data_individu")
            ->where("id_anak","=",$id)
            ->first();
        if($kueri->irl === 0)
        {
            DB::table("data_individu")
                ->where("id_anak", "=", $id)
                ->update([
                    "irl" => 1,
                    "tanggal_irl" => (string)date_format(date_create(), "Y-m-d")
                ]);
        }
    }

    public function ubahT($id, $status)
    {
        $kueri = DB::table("data_individu")
            ->where("id_anak","=",$id)
            ->first();
        if($kueri->status_t !== "T".$status)
        {
            DB::table("data_individu")
                ->where("id_anak", "=", $id)
                ->update([
                    "status_t" => "T" . $status,
                    "tanggal_t" => (string)date_format(date_create(), "Y-m-d")
                ]);
        }
    }

    public function daftarAntigen()
    {
        return DB::table("antigen")
            ->select("id_antigen","nama_antigen")
            ->get();
    }

    public function daftarPuskesmas($id_pus)
    {
        return DB::table("puskesmas")
            ->where("id_kabupaten","=",$id_pus)
            ->select("id_puskesmas","nama_puskesmas")
            ->orderBy("nama_puskesmas")
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
            ->select("id_posyandu","nama_posyandu")
            ->orderBy("nama_posyandu")
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
            ->join("posyandu","data_individu.id_posyandu","=","posyandu.id_posyandu")
            ->join("kampung","posyandu.id_kampung","=","kampung.id_kampung")
            ->where("id_puskesmas","=",$id_pus)
            ->orderBy("nama_lengkap")
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

    public function dataDetailImunisasiIDL($id)
    {
        return DB::table("imunisasi")
            ->join("antigen","imunisasi.id_antigen","=","antigen.id_antigen")
            ->where("id_anak","=",$id)
            ->where("antigen.id_antigen","<=",11)
            ->get();
    }

    public function dataDetailImunisasiIRL($id)
    {
        return DB::table("imunisasi")
            ->join("antigen","imunisasi.id_antigen","=","antigen.id_antigen")
            ->where("id_anak","=",$id)
            ->where("antigen.id_antigen",">=",12)
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
        return DB::table("data_individu")
            ->where("id_anak","=",$request->idAnak)
            ->update([
                "nama_lengkap" => $request->namaLengkap,
                "nama_ibu" => $request->namaIbuKandung,
                "nik" => $request->nik,
                "tanggal_lahir" => $request->tanggalLahir,
                "jenis_kelamin" => $request->jenisKelamin,
                "no_hp" => $request->noHP,
                "alamat" => $request->alamat,
                "id_posyandu" => $request->posyandu,
                "status_hamil" => $request->isHamil ?: null,
                "tanggal_hamil" => $request->tanggalKehamilan ?: null
            ]);
    }

    public function dataTambahKirim(Request $request)
    {
        $cek = DB::table("data_individu")
            ->where("nama_ibu","=",$request->namaIbuKandung)
            ->where("jenis_kelamin","=",$request->jenisKelamin)
            ->where("tanggal_lahir","=",$request->tanggalLahir)
            ->get();
        if($cek === 0)
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
                return $id->id_anak;
            }
            return 0;
        }
        return -1;
    }

    public function dataKonfirmasi($id)
    {
        return DB::table("data_individu")
            ->join("kampung","data_individu.id_kampung","=","kampung.id_kampung")
            ->join("posyandu","data_individu.id_posyandu","=","posyandu.id_posyandu")
            ->join("puskesmas","kampung.id_puskesmas","=","puskesmas.id_puskesmas")
            ->join("kabupaten","puskesmas.id_kabupaten","=","kabupaten.id_kabupaten")
            ->where("id_anak","=",$id)
            ->first();
    }

    public function dataHapus($id)
    {
        $kueri = DB::table("imunisasi")
            ->where("id_anak","=",$id)
            ->delete();
        if($kueri > 0)
        {
            return DB::table("data_individu")
                ->where("id_anak","=",$id)
                ->delete();
        }
        return 0;
    }

    public function akunDashboard($id_pus)
    {
        return DB::table("user")
            ->join("puskesmas","user.id_puskesmas","=","puskesmas.id_puskesmas")
            ->where("user.id_puskesmas","=",$id_pus)
            ->select("id_user","nama_puskesmas","username","nama","email","level")
            ->orderBy("level","desc")
            ->orderBy("nama")
            ->get();
    }

    public function akunEdit($id)
    {
        return DB::table("user")
            ->join("puskesmas","user.id_puskesmas","=","puskesmas.id_puskesmas")
            ->where("id_user","=",$id)
            ->select("nama_puskesmas","id_user","level","username","nama","email")
            ->first();
    }

    public function akunEditKirim(Request $request, $id_pus, $id_kab)
    {
        return DB::table("user")
            ->where("id_user","=",$request->idUser)
            ->update([
                "username" => $request->username,
                "nama" => $request->nama,
                "email" => $request->email,
                "level" => $request->level,
                "id_kabupaten" => $id_kab,
                "id_puskesmas" => $id_pus
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
            return DB::table("user")
                ->where("id_user","=",$request->idUser)
                ->update([
                    "password" => Hash::make($request->passwordBaru),
                ]);
        }
        return 0;
    }

    public function akunTambahKirim(Request $request, $id_pus, $id_kab)
    {
        if($request->password == $request->password2)
        {
            return DB::table("user")
                ->insert([
                    "nama" => $request->nama,
                    "username" => $request->username,
                    "email" => $request->email,
                    "password" => Hash::make($request->password),
                    "level" => $request->level,
                    "id_kabupaten" => $id_kab,
                    "id_puskesmas" => $id_pus
                ]);
        }
        return 0;
    }

    public function akunHapusKirim($id)
    {
        return DB::table("user")
            ->where("id_user","=",$id)
            ->delete();
    }

    public function kampungDashboard($id_pus)
    {
        return DB::table("kampung")
            ->where("id_puskesmas","=",$id_pus)
            ->orderBy("nama_kampung")
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

    public function kampungTambahKirim(Request $request, $id_pus)
    {
        return DB::table("kampung")
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
        return DB::table("kampung")
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
                "wus_hamil" => $request->wusHamil,
                "wus_tidak_hamil" => $request->wusTidakHamil
            ]);
    }

    public function posyanduDashboard($id_pus)
    {
        return DB::table("posyandu")
            ->join("kampung","posyandu.id_kampung","=","kampung.id_kampung")
            ->where("id_puskesmas","=",$id_pus)
            ->orderBy("nama_posyandu")
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

    public function posLaporan($id, $id_pus)
    {
        return DB::table("data_individu")
            ->join("imunisasi","data_individu.id_anak","=","imunisasi.id_anak")
            ->join("posyandu","data_individu.id_posyandu","=","posyandu.id_posyandu")
            ->join("kampung","posyandu.id_kampung","=","kampung.id_kampung")
            ->where("id_puskesmas","=",$id_pus)
            ->where("id_antigen","=",$id)
            ->orderBy("nama_lengkap")
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
            ->orderBy("nama_lengkap")
            ->get();
    }

    public function getListPuskesmas()
    {
        return DB::table("puskesmas")->select("id_puskesmas","nama_puskesmas")->get();
    }

    public function getListPuskesmasByKabupatenId($id)
    {
        return DB::table("puskesmas")
            ->join("kabupaten","puskesmas.id_kabupaten","=","kabupaten.id_kabupaten")
            ->where("kabupaten.id_kabupaten","=",$id)
            ->select("puskesmas.id_puskesmas","puskesmas.nama_puskesmas")
            ->get();
    }

    public function getListPuskesmasById($id)
    {
        return DB::table("puskesmas")
            ->where("id_puskesmas","=",$id)
            ->select("id_puskesmas","nama_puskesmas")
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
        return DB::table("imunisasi")
            ->where("id_anak","=",$request->idAnak)
            ->where("id_antigen","=",$request->antigen)
            ->update([
                "tanggal_pemberian" => (string)date_format(date_create($request->tanggal), "Y-m-d"),
                "tempat_imunisasi" => $request->lokasi,
                "status" => "sudah"
            ]);
    }
}
