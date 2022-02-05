<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProvinsiModel;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ProvinsiController extends Controller
{
    public function index()
    {
        return view("provinsi.dashboard");
    }

    /*
     * ANTIGEN
     */
    public function antigenDashboard()
    {
        $kueri = (new ProvinsiModel)->antigenDashboard();
        return view("provinsi.antigen.dashboard",["data" => $kueri]);
    }

    public function antigenEdit($id)
    {
        $kueri = (new ProvinsiModel)->antigenEdit($id);
        return view("provinsi.antigen.editAntigen",["data" => $kueri]);
    }

    public function antigenEditKirim(Request $request)
    {
        $kueri = (new ProvinsiModel)->antigenEditKirim($request);
        if(count($kueri) > 0)
        {
            return redirect("/provinsi/antigen/dashboard")->with("sukses","Data Antigen berhasil disimpan");
        }
        return redirect("/provinsi/antigen/dashboard")->with("gagal","Data Antigen gagal disimpan");
    }

    public function antigenTambah()
    {
        return view("provinsi.antigen.tambahAntigen");
    }

    public function antigenTambahKirim(Request $request)
    {
        $kueri = (new ProvinsiModel)->antigenTambahKirim($request);
        if($kueri > 0)
        {
            return redirect("/provinsi/antigen/dashboard")->with("sukses","Data Antigen berhasil disimpan");
        }
        return redirect("/provinsi/antigen/dashboard")->with("gagal","Data Antigen gagal disimpan");

    }

    /*
     * CAPAIAN
     */
    public function capaianKabupaten()
    {
        $tahunForm = 2020;
        $kabupatenForm = 1;
        $query = DB::SELECT("SELECT kabupaten.nama_kabupaten as kabupaten,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (kabupaten.bayi_lahir_L+kabupaten.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (kabupaten.baduta_L+kabupaten.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (kabupaten.sd_1_L+kabupaten.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (kabupaten.sd_2_L+kabupaten.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (kabupaten.sd_5_L+kabupaten.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (kabupaten.sd_6_L+kabupaten.sd_6_P)
              ELSE (kabupaten.surviving_infant_L+kabupaten.surviving_infant_P) END)*0.95) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY antigen.id_antigen
        ORDER BY kabupaten.id_kabupaten");
        $query1 = DB::SELECT("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (kabupaten.bayi_lahir_L+kabupaten.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (kabupaten.baduta_L+kabupaten.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (kabupaten.sd_1_L+kabupaten.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (kabupaten.sd_2_L+kabupaten.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (kabupaten.sd_5_L+kabupaten.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (kabupaten.sd_6_L+kabupaten.sd_6_P)
              ELSE (kabupaten.surviving_infant_L+kabupaten.surviving_infant_P) END)*0.95/12) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY antigen.id_antigen
        ORDER BY kabupaten.id_kabupaten
    ");
        $query2 = DB::SELECT("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (kabupaten.bayi_lahir_L+kabupaten.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (kabupaten.baduta_L+kabupaten.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (kabupaten.sd_1_L+kabupaten.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (kabupaten.sd_2_L+kabupaten.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (kabupaten.sd_5_L+kabupaten.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (kabupaten.sd_6_L+kabupaten.sd_6_P)
              ELSE (kabupaten.surviving_infant_L+kabupaten.surviving_infant_P) END)*0.95/12) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY antigen.id_antigen
        ORDER BY kabupaten.id_kabupaten
    ");
        $query3 = DB::SELECT("SELECT kabupaten.nama_kabupaten as kabupaten,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (kabupaten.bayi_lahir_L+kabupaten.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (kabupaten.baduta_L+kabupaten.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (kabupaten.sd_1_L+kabupaten.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (kabupaten.sd_2_L+kabupaten.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (kabupaten.sd_5_L+kabupaten.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (kabupaten.sd_6_L+kabupaten.sd_6_P)
              ELSE (kabupaten.surviving_infant_L+kabupaten.surviving_infant_P) END)*0.95/12) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY antigen.id_antigen
        ORDER BY kabupaten.id_kabupaten");
        $query4 = DB::SELECT("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (kabupaten.bayi_lahir_L+kabupaten.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (kabupaten.baduta_L+kabupaten.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (kabupaten.sd_1_L+kabupaten.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (kabupaten.sd_2_L+kabupaten.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (kabupaten.sd_5_L+kabupaten.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (kabupaten.sd_6_L+kabupaten.sd_6_P)
              ELSE (kabupaten.surviving_infant_L+kabupaten.surviving_infant_P) END)*0.95/12) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY antigen.id_antigen
        ORDER BY kabupaten.id_kabupaten
    ");
        $query5 = DB::SELECT("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (kabupaten.bayi_lahir_L+kabupaten.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (kabupaten.baduta_L+kabupaten.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (kabupaten.sd_1_L+kabupaten.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (kabupaten.sd_2_L+kabupaten.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (kabupaten.sd_5_L+kabupaten.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (kabupaten.sd_6_L+kabupaten.sd_6_P)
              ELSE (kabupaten.surviving_infant_L+kabupaten.surviving_infant_P) END)*0.95/12) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY antigen.id_antigen
        ORDER BY kabupaten.id_kabupaten
    ");
        $query6 = DB::SELECT("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (kabupaten.bayi_lahir_L+kabupaten.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (kabupaten.baduta_L+kabupaten.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (kabupaten.sd_1_L+kabupaten.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (kabupaten.sd_2_L+kabupaten.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (kabupaten.sd_5_L+kabupaten.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (kabupaten.sd_6_L+kabupaten.sd_6_P)
              ELSE (kabupaten.surviving_infant_L+kabupaten.surviving_infant_P) END)*0.95/12) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY antigen.id_antigen
        ORDER BY kabupaten.id_kabupaten
    ");
        $query7 = DB::SELECT("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (kabupaten.bayi_lahir_L+kabupaten.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (kabupaten.baduta_L+kabupaten.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (kabupaten.sd_1_L+kabupaten.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (kabupaten.sd_2_L+kabupaten.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (kabupaten.sd_5_L+kabupaten.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (kabupaten.sd_6_L+kabupaten.sd_6_P)
              ELSE (kabupaten.surviving_infant_L+kabupaten.surviving_infant_P) END)*0.95/12) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY antigen.id_antigen
        ORDER BY kabupaten.id_kabupaten
    ");
        $query8 = DB::SELECT("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (kabupaten.bayi_lahir_L+kabupaten.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (kabupaten.baduta_L+kabupaten.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (kabupaten.sd_1_L+kabupaten.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (kabupaten.sd_2_L+kabupaten.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (kabupaten.sd_5_L+kabupaten.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (kabupaten.sd_6_L+kabupaten.sd_6_P)
              ELSE (kabupaten.surviving_infant_L+kabupaten.surviving_infant_P) END)*0.95/12) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY antigen.id_antigen
        ORDER BY kabupaten.id_kabupaten
    ");

        $query9 = DB::SELECT("SELECT kabupaten.nama_kabupaten as kabupaten,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 9 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (kabupaten.bayi_lahir_L+kabupaten.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (kabupaten.baduta_L+kabupaten.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (kabupaten.sd_1_L+kabupaten.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (kabupaten.sd_2_L+kabupaten.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (kabupaten.sd_5_L+kabupaten.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (kabupaten.sd_6_L+kabupaten.sd_6_P)
              ELSE (kabupaten.surviving_infant_L+kabupaten.surviving_infant_P) END)*0.95/12) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY antigen.id_antigen
        ORDER BY kabupaten.id_kabupaten");

        $query10 = DB::SELECT("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (kabupaten.bayi_lahir_L+kabupaten.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (kabupaten.baduta_L+kabupaten.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (kabupaten.sd_1_L+kabupaten.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (kabupaten.sd_2_L+kabupaten.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (kabupaten.sd_5_L+kabupaten.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (kabupaten.sd_6_L+kabupaten.sd_6_P)
              ELSE (kabupaten.surviving_infant_L+kabupaten.surviving_infant_P) END)*0.95/12) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY antigen.id_antigen
        ORDER BY kabupaten.id_kabupaten
    ");

        $query11 = DB::SELECT("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (kabupaten.bayi_lahir_L+kabupaten.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (kabupaten.baduta_L+kabupaten.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (kabupaten.sd_1_L+kabupaten.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (kabupaten.sd_2_L+kabupaten.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (kabupaten.sd_5_L+kabupaten.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (kabupaten.sd_6_L+kabupaten.sd_6_P)
              ELSE (kabupaten.surviving_infant_L+kabupaten.surviving_infant_P) END)*0.95/12) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY antigen.id_antigen
        ORDER BY kabupaten.id_kabupaten
    ");

        $query12 = DB::SELECT("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (kabupaten.bayi_lahir_L+kabupaten.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (kabupaten.baduta_L+kabupaten.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (kabupaten.sd_1_L+kabupaten.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (kabupaten.sd_2_L+kabupaten.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (kabupaten.sd_5_L+kabupaten.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (kabupaten.sd_6_L+kabupaten.sd_6_P)
              ELSE (kabupaten.surviving_infant_L+kabupaten.surviving_infant_P) END)*0.95/12) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY antigen.id_antigen
        ORDER BY kabupaten.id_kabupaten
    ");

        return view("provinsi.capaian.capaianKabupaten", ["query" => $query, "query1" => $query1, "query2" => $query2, "query3" => $query3, "query4" => $query4, "query5" => $query5, "query6" => $query6, "query7" => $query7, "query8" => $query8, "query9" => $query9, "query10" => $query10, "query11" => $query11, "query12" => $query12]);
    }

    public function capaianKampung()
    {
        return view("provinsi.capaian.capaianKampung");
    }

    public function capaianProvinsi()
    {
        return view("provinsi.capaian.capaianProvinsi");
    }

    public function capaianPuskesmas()
    {
        return view("provinsi.capaian.capaianPuskesmas");
    }

    /*
     * DATA ANAK
     */
    public function anakDashboard(Request $request)
    {
        if ($request->ajax()) {
            $data = (new ProvinsiModel)->anakDashboard();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view("provinsi.dataIndividu.dashboard");
    }

    public function anakDetail($id)
    {
        $kueri = (new ProvinsiModel)->anakDetail($id);
        $kueri2 = (new ProvinsiModel)->anakDetailImunisasi($id);
        return view("provinsi.dataIndividu.detailDataIndividu",["data" => $kueri, "data2" => $kueri2]);
    }

    /*
     * MANAJEMEN AKUN
     */
    public function akunDashboard()
    {
        $kueri = (new ProvinsiModel)->akunDashboard();
        return view("provinsi.manajemenAkun.dashboard",["data" => $kueri]);
    }

    public function akunEdit($id)
    {
        $kueri = (new ProvinsiModel)->akunEdit($id);
        return view("provinsi.manajemenAkun.editAkun",["data" => $kueri]);
    }

    public function akunEditKirim(Request $request)
    {
        $kueri = (new ProvinsiModel)->akunEditKirim($request);
        if($kueri > 0)
        {
            return redirect("/provinsi/akun/dashboard")->with("sukses","Data berhasil disimpan");
        }
        return redirect("/provinsi/akun/dashboard")->with("gagal","Data gagal disimpan");
    }

    public function akunGantiPass($id)
    {
        $kueri = (new ProvinsiModel)->akunGantiPass($id);
        return view("provinsi.manajemenAkun.gantiPassword",["data" => $kueri]);
    }

    public function akunGantiPassKirim(Request $request)
    {
        $kueri = (new ProvinsiModel)->akunGantiPassKirim($request);
        if($kueri > 0)
        {
            return redirect("/provinsi/akun/dashboard")->with("sukses","Password berhasil diubah");
        }
        return redirect("/provinsi/akun/dashboard")->with("gagal","Password gagal diubah");
    }

    public function akunTambah()
    {
        return view("provinsi.manajemenAkun.tambahAkun");
    }

    public function akunTambahKirim(Request $request)
    {
        $kueri = (new ProvinsiModel)->akunTambahKirim($request);
        if($kueri > 0)
        {
            return redirect("/provinsi/akun/dashboard")->with("sukses","Akun baru berhasil ditambahkan");
        }
        return redirect("/provinsi/akun/dashboard")->with("gagal","Akun baru gagal ditambahkan");
    }

    public function akunHapusKirim($id)
    {
        (new ProvinsiModel)->akunHapusKirim($id);
        return redirect("/provinsi/akun/dashboard")->with("sukses","Akun berhasil dihapus");
    }

    /*
     * REGIONAL KAMPUNG
     */
    public function kampungDashboard(Request $request)
    {
        if ($request->ajax()) {
            $data = (new ProvinsiModel)->kampungDashboard();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view("provinsi.regional.dashboard");
    }

    public function kampungEdit($id)
    {
        $kueri = (new ProvinsiModel)->kampungEdit($id);
        $kueri2 = (new ProvinsiModel)->daftarPuskesmas();
        return view("provinsi.regional.editData",["data" => $kueri,"data2" => $kueri2]);
    }

    public function kampungEditKirim(Request $request)
    {
        $kueri = (new ProvinsiModel)->kampungEditKirim($request);
        if(count($kueri) > 0)
        {
            return redirect("/provinsi/regional-kampung/dashboard")->with("sukses","Data Kampung berhasil disimpan");
        }
        return redirect("/provinsi/regional-kampung/dashboard")->with("gagal","Data Kampung gagal disimpan");
    }

    public function kampungTambah()
    {
        $kueri = (new ProvinsiModel)->daftarPuskesmas();
        return view("provinsi.regional.tambahData",["data2"=>$kueri]);
    }

    public function kampungTambahKirim(Request $request)
    {
        $kueri = (new ProvinsiModel)->kampungTambahKirim($request);
        if(count($kueri) > 0)
        {
            return redirect("/provinsi/regional-kampung/dashboard")->with("sukses","Data Kampung berhasil disimpan");
        }
        return redirect("/provinsi/regional-kampung/dashboard")->with("gagal","Data Kampung gagal disimpan");
    }

    /*
     * REGIONAL POSYANDU
     */
    public function posyanduDashboard(Request $request)
    {
        if ($request->ajax()) {
            $data = (new ProvinsiModel)->posyanduDashboard();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view("provinsi.regionalPosyandu.dashboard");
    }

    public function posyanduEdit($id)
    {
        $kueri = (new ProvinsiModel)->posyanduEdit($id);
        $kueri2 = (new ProvinsiModel)->daftarKampung();
        return view("provinsi.regionalPosyandu.editData",["data" => $kueri, "data2" => $kueri2]);
    }

    public function posyanduEditKirim(Request $request)
    {
        $kueri = (new ProvinsiModel)->posyanduEditKirim($request);
        if(count($kueri) > 0)
        {
            return redirect("/provinsi/regional-posyandu/dashboard")->with("sukses","Data Posyandu berhasil disimpan");
        }
        return redirect("/provinsi/regional-posyandu/dashboard")->with("gagal","Data Posyandu gagal disimpan");
    }

    public function posyanduTambah()
    {
        $kueri = (new ProvinsiModel)->daftarKampung();
        return view("provinsi.regionalPosyandu.tambahData",["data2"=>$kueri]);
    }

    public function posyanduTambahKirim(Request $request)
    {
        $kueri = (new ProvinsiModel)->posyanduTambahKirim($request);
        if(count($kueri) > 0)
        {
            return redirect("/provinsi/regional-posyandu/dashboard")->with("sukses","Data Posyandu berhasil disimpan");
        }
        return redirect("/provinsi/regional-posyandu/dashboard")->with("gagal","Data Posyandu gagal disimpan");
    }

    public function kabupatenDashboard()
    {
        $kueri = (new ProvinsiModel)->kabupatenDashboard();
        return view("provinsi.regionalKabupaten.dashboard",["data"=>$kueri]);
    }

    public function kabupatenEdit($id)
    {
        $kueri = (new ProvinsiModel)->kabupatenEdit($id);
        return view("provinsi.regionalKabupaten.editData",["data" => $kueri]);
    }

    public function kabupatenEditKirim(Request $request)
    {
        $kueri = (new ProvinsiModel)->kabupatenEditKirim($request);
        if(count($kueri) > 0)
        {
            return redirect("/provinsi/regional-kabupaten/dashboard")->with("sukses","Data Kabupaten berhasil disimpan");
        }
        return redirect("/provinsi/regional-kabupaten/dashboard")->with("gagal","Data Kabupaten gagal disimpan");
    }

    public function kabupatenTambah()
    {
        return view("provinsi.regionalKabupaten.tambahData");
    }

    public function kabupatenTambahKirim(Request $request)
    {
        $kueri = (new ProvinsiModel)->kabupatenTambahKirim($request);
        if(count($kueri) > 0)
        {
            return redirect("/provinsi/regional-kabupaten/dashboard")->with("sukses","Data Kabupaten berhasil disimpan");
        }
        return redirect("/provinsi/regional-kabupaten/dashboard")->with("gagal","Data Kabupaten gagal disimpan");
    }

    public function puskesmasDashboard(Request $request)
    {
        if ($request->ajax()) {
            $data = (new ProvinsiModel)->puskesmasDashboard();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view("provinsi.regionalPuskesmas.dashboard");
    }

    public function puskesmasEdit($id)
    {
        $kueri = (new ProvinsiModel)->puskesmasEdit($id);
        $kueri2 = (new ProvinsiModel)->daftarKabupaten();
        return view("provinsi.regionalPuskesmas.editData",["data" => $kueri, "data2" => $kueri2]);
    }

    public function puskesmasEditKirim(Request $request)
    {
        $kueri = (new ProvinsiModel)->puskesmasEditKirim($request);
        if(count($kueri) > 0)
        {
            return redirect("/provinsi/regional-puskesmas/dashboard")->with("sukses","Data Puskesmas berhasil disimpan");
        }
        return redirect("/provinsi/regional-puskesmas/dashboard")->with("gagal","Data Puskesmas gagal disimpan");
    }

    public function puskesmasTambah()
    {
        $kueri = (new ProvinsiModel)->daftarKabupaten();
        return view("provinsi.regionalPuskesmas.tambahData",["data2"=>$kueri]);
    }

    public function puskesmasTambahKirim(Request $request)
    {
        $kueri = (new ProvinsiModel)->puskesmasTambahKirim($request);
        if(count($kueri) > 0)
        {
            return redirect("/provinsi/regional-puskesmas/dashboard")->with("sukses","Data Puskesmas berhasil disimpan");
        }
        return redirect("/provinsi/regional-puskesmas/dashboard")->with("gagal","Data Puskesmas gagal disimpan");
    }

    public function sasaranDashboard(Request $request)
    {
        if ($request->ajax()) {
            $data = (new ProvinsiModel)->sasaranDashboard();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view("provinsi.sasaran.dashboard");
    }

    public function sasaranTarget($id)
    {
        $kueri = (new ProvinsiModel)->sasaranTarget($id);
        return view("provinsi.sasaran.target",["data" => $kueri]);
    }
}
