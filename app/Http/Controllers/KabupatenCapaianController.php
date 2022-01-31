<?php

namespace App\Http\Controllers;

use App\Models\AntigenModel;
use App\Models\PuskesmasModel;
use App\Models\KabupatenModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class KabupatenCapaianController extends Controller
{
    public function capaianAntigenKabupaten(Request $request)
    {
        $tahunForm = $request->tahunForm ?: 2020;
        $kabupatenForm = $request->kabupatenForm ?: 1;
        $kabupatens = (new KabupatenModel)->getListKabupaten();

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


        return view("kabupaten.capaian.capaianAntigenKabupaten", ["query" => $query, "query1" => $query1, "query2" => $query2, "query3" => $query3, "query4" => $query4, "query5" => $query5, "query6" => $query6, "query7" => $query7, "query8" => $query8, "query9" => $query9, "query10" => $query10, "query11" => $query11, "query12" => $query12, "tahunForm" => $tahunForm, "kabupatenForm" => $kabupatenForm, 'kabupatens'=>$kabupatens]);
    }

    public function capaianAntigenKampung(Request $request){
        $tahunForm = $request->tahunForm ?: 2020;
        $kabupatenForm = $request->kabupatenForm ?: 1;
        $puskesmasForm = $request->puskesmasForm ?: 1;
        $antigenForm = $request->antigenForm ?: 1;

        $antigens = (new AntigenModel)->getListAntigen();
        $puskesmas = (new PuskesmasModel())->getListPuskesmas();
        $puskesmas = [$puskesmas[$puskesmasForm]];
        $kabupatens = (new KabupatenModel)->getListKabupaten();

        if ($antigenForm==1 || $antigenForm==2 || $antigenForm==3) {
            $query = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.bayi_lahir_L + kampung.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung
        ");



            $query1 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.bayi_lahir_L + kampung.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query2 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.bayi_lahir_L + kampung.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query3 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
        ROUND((ROUND(AVG(kampung.bayi_lahir_L + kampung.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
      FROM kampung
        LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
        LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
        LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
        LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
        LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
      WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        AND puskesmas.id_puskesmas = {$puskesmasForm}
      GROUP BY kampung.id_kampung
      ORDER BY kampung.id_kampung

      ");



            $query4 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.bayi_lahir_L + kampung.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query5 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
        ROUND((ROUND(AVG(kampung.bayi_lahir_L + kampung.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
      FROM kampung
        LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
        LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
        LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
        LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
        LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
      WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        AND puskesmas.id_puskesmas = {$puskesmasForm}
      GROUP BY kampung.id_kampung
      ORDER BY kampung.id_kampung

      ");



            $query6 = DB::select("
      SELECT kabupaten.nama_kabupaten as kabupaten,
      puskesmas.nama_puskesmas as puskesmas,
      kampung.nama_kampung as kampung,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
      ROUND((ROUND(AVG(kampung.bayi_lahir_L + kampung.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
    FROM kampung
      LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
      LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
      LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
      LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
      LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
    WHERE kabupaten.id_kabupaten = {$kabupatenForm}
      AND puskesmas.id_puskesmas = {$puskesmasForm}
    GROUP BY kampung.id_kampung
    ORDER BY kampung.id_kampung

    ");



            $query7 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
    puskesmas.nama_puskesmas as puskesmas,
    kampung.nama_kampung as kampung,
    SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
    SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
    SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
    ROUND((ROUND(AVG(kampung.bayi_lahir_L + kampung.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
  FROM kampung
    LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
    LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
    LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
    LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
    LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
  WHERE kabupaten.id_kabupaten = {$kabupatenForm}
    AND puskesmas.id_puskesmas = {$puskesmasForm}
  GROUP BY kampung.id_kampung
  ORDER BY kampung.id_kampung

  ");



            $query8 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.bayi_lahir_L + kampung.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query9 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.bayi_lahir_L + kampung.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");




            $query10 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
        ROUND((ROUND(AVG(kampung.bayi_lahir_L + kampung.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
      FROM kampung
        LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
        LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
        LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
        LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
        LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
      WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        AND puskesmas.id_puskesmas = {$puskesmasForm}
      GROUP BY kampung.id_kampung
      ORDER BY kampung.id_kampung

      ");




            $query11 = DB::select("
      SELECT kabupaten.nama_kabupaten as kabupaten,
      puskesmas.nama_puskesmas as puskesmas,
      kampung.nama_kampung as kampung,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
      ROUND((ROUND(AVG(kampung.bayi_lahir_L + kampung.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
    FROM kampung
      LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
      LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
      LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
      LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
      LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
    WHERE kabupaten.id_kabupaten = {$kabupatenForm}
      AND puskesmas.id_puskesmas = {$puskesmasForm}
    GROUP BY kampung.id_kampung
    ORDER BY kampung.id_kampung

    ");



            $query12 = DB::select("
      SELECT kabupaten.nama_kabupaten as kabupaten,
      puskesmas.nama_puskesmas as puskesmas,
      kampung.nama_kampung as kampung,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
      ROUND((ROUND(AVG(kampung.bayi_lahir_L + kampung.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
    FROM kampung
      LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
      LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
      LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
      LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
      LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
    WHERE kabupaten.id_kabupaten = {$kabupatenForm}
      AND puskesmas.id_puskesmas = {$puskesmasForm}
    GROUP BY kampung.id_kampung
    ORDER BY kampung.id_kampung

    ");




        }
        elseif ($antigenForm==12 || $antigenForm==13) {
            $query = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.baduta_L + kampung.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung
        ");



            $query1 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.baduta_L + kampung.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query2 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.baduta_L + kampung.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query3 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
        ROUND((ROUND(AVG(kampung.baduta_L + kampung.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
      FROM kampung
        LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
        LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
        LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
        LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
        LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
      WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        AND puskesmas.id_puskesmas = {$puskesmasForm}
      GROUP BY kampung.id_kampung
      ORDER BY kampung.id_kampung

      ");



            $query4 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.baduta_L + kampung.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query5 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
        ROUND((ROUND(AVG(kampung.baduta_L + kampung.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
      FROM kampung
        LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
        LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
        LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
        LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
        LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
      WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        AND puskesmas.id_puskesmas = {$puskesmasForm}
      GROUP BY kampung.id_kampung
      ORDER BY kampung.id_kampung

      ");



            $query6 = DB::select("
      SELECT kabupaten.nama_kabupaten as kabupaten,
      puskesmas.nama_puskesmas as puskesmas,
      kampung.nama_kampung as kampung,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
      ROUND((ROUND(AVG(kampung.baduta_L + kampung.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
    FROM kampung
      LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
      LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
      LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
      LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
      LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
    WHERE kabupaten.id_kabupaten = {$kabupatenForm}
      AND puskesmas.id_puskesmas = {$puskesmasForm}
    GROUP BY kampung.id_kampung
    ORDER BY kampung.id_kampung

    ");



            $query7 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
    puskesmas.nama_puskesmas as puskesmas,
    kampung.nama_kampung as kampung,
    SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
    SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
    SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
    ROUND((ROUND(AVG(kampung.baduta_L + kampung.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
  FROM kampung
    LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
    LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
    LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
    LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
    LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
  WHERE kabupaten.id_kabupaten = {$kabupatenForm}
    AND puskesmas.id_puskesmas = {$puskesmasForm}
  GROUP BY kampung.id_kampung
  ORDER BY kampung.id_kampung

  ");



            $query8 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.baduta_L + kampung.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query9 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.baduta_L + kampung.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");




            $query10 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
        ROUND((ROUND(AVG(kampung.baduta_L + kampung.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
      FROM kampung
        LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
        LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
        LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
        LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
        LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
      WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        AND puskesmas.id_puskesmas = {$puskesmasForm}
      GROUP BY kampung.id_kampung
      ORDER BY kampung.id_kampung

      ");




            $query11 = DB::select("
      SELECT kabupaten.nama_kabupaten as kabupaten,
      puskesmas.nama_puskesmas as puskesmas,
      kampung.nama_kampung as kampung,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
      ROUND((ROUND(AVG(kampung.baduta_L + kampung.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
    FROM kampung
      LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
      LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
      LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
      LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
      LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
    WHERE kabupaten.id_kabupaten = {$kabupatenForm}
      AND puskesmas.id_puskesmas = {$puskesmasForm}
    GROUP BY kampung.id_kampung
    ORDER BY kampung.id_kampung

    ");



            $query12 = DB::select("
      SELECT kabupaten.nama_kabupaten as kabupaten,
      puskesmas.nama_puskesmas as puskesmas,
      kampung.nama_kampung as kampung,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
      ROUND((ROUND(AVG(kampung.baduta_L + kampung.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
    FROM kampung
      LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
      LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
      LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
      LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
      LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
    WHERE kabupaten.id_kabupaten = {$kabupatenForm}
      AND puskesmas.id_puskesmas = {$puskesmasForm}
    GROUP BY kampung.id_kampung
    ORDER BY kampung.id_kampung

    ");




        }
        elseif ($antigenForm==14 || $antigenForm==15) {
            $query = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.sd_1_L + kampung.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung
        ");



            $query1 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.sd_1_L + kampung.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query2 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.sd_1_L + kampung.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query3 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
        ROUND((ROUND(AVG(kampung.sd_1_L + kampung.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
      FROM kampung
        LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
        LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
        LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
        LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
        LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
      WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        AND puskesmas.id_puskesmas = {$puskesmasForm}
      GROUP BY kampung.id_kampung
      ORDER BY kampung.id_kampung

      ");



            $query4 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.sd_1_L + kampung.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query5 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
        ROUND((ROUND(AVG(kampung.sd_1_L + kampung.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
      FROM kampung
        LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
        LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
        LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
        LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
        LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
      WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        AND puskesmas.id_puskesmas = {$puskesmasForm}
      GROUP BY kampung.id_kampung
      ORDER BY kampung.id_kampung

      ");



            $query6 = DB::select("
      SELECT kabupaten.nama_kabupaten as kabupaten,
      puskesmas.nama_puskesmas as puskesmas,
      kampung.nama_kampung as kampung,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
      ROUND((ROUND(AVG(kampung.sd_1_L + kampung.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
    FROM kampung
      LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
      LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
      LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
      LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
      LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
    WHERE kabupaten.id_kabupaten = {$kabupatenForm}
      AND puskesmas.id_puskesmas = {$puskesmasForm}
    GROUP BY kampung.id_kampung
    ORDER BY kampung.id_kampung

    ");



            $query7 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
    puskesmas.nama_puskesmas as puskesmas,
    kampung.nama_kampung as kampung,
    SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
    SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
    SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
    ROUND((ROUND(AVG(kampung.sd_1_L + kampung.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
  FROM kampung
    LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
    LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
    LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
    LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
    LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
  WHERE kabupaten.id_kabupaten = {$kabupatenForm}
    AND puskesmas.id_puskesmas = {$puskesmasForm}
  GROUP BY kampung.id_kampung
  ORDER BY kampung.id_kampung

  ");



            $query8 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.sd_1_L + kampung.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query9 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.sd_1_L + kampung.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");




            $query10 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
        ROUND((ROUND(AVG(kampung.sd_1_L + kampung.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
      FROM kampung
        LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
        LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
        LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
        LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
        LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
      WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        AND puskesmas.id_puskesmas = {$puskesmasForm}
      GROUP BY kampung.id_kampung
      ORDER BY kampung.id_kampung

      ");




            $query11 = DB::select("
      SELECT kabupaten.nama_kabupaten as kabupaten,
      puskesmas.nama_puskesmas as puskesmas,
      kampung.nama_kampung as kampung,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
      ROUND((ROUND(AVG(kampung.sd_1_L + kampung.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
    FROM kampung
      LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
      LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
      LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
      LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
      LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
    WHERE kabupaten.id_kabupaten = {$kabupatenForm}
      AND puskesmas.id_puskesmas = {$puskesmasForm}
    GROUP BY kampung.id_kampung
    ORDER BY kampung.id_kampung

    ");



            $query12 = DB::select("
      SELECT kabupaten.nama_kabupaten as kabupaten,
      puskesmas.nama_puskesmas as puskesmas,
      kampung.nama_kampung as kampung,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
      ROUND((ROUND(AVG(kampung.sd_1_L + kampung.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
    FROM kampung
      LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
      LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
      LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
      LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
      LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
    WHERE kabupaten.id_kabupaten = {$kabupatenForm}
      AND puskesmas.id_puskesmas = {$puskesmasForm}
    GROUP BY kampung.id_kampung
    ORDER BY kampung.id_kampung

    ");




        }
        elseif ($antigenForm==16) {
            $query = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.sd_2_L + kampung.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung
        ");



            $query1 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.sd_2_L + kampung.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query2 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.sd_2_L + kampung.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query3 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
        ROUND((ROUND(AVG(kampung.sd_2_L + kampung.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
      FROM kampung
        LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
        LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
        LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
        LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
        LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
      WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        AND puskesmas.id_puskesmas = {$puskesmasForm}
      GROUP BY kampung.id_kampung
      ORDER BY kampung.id_kampung

      ");



            $query4 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.sd_2_L + kampung.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query5 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
        ROUND((ROUND(AVG(kampung.sd_2_L + kampung.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
      FROM kampung
        LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
        LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
        LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
        LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
        LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
      WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        AND puskesmas.id_puskesmas = {$puskesmasForm}
      GROUP BY kampung.id_kampung
      ORDER BY kampung.id_kampung

      ");



            $query6 = DB::select("
      SELECT kabupaten.nama_kabupaten as kabupaten,
      puskesmas.nama_puskesmas as puskesmas,
      kampung.nama_kampung as kampung,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
      ROUND((ROUND(AVG(kampung.sd_2_L + kampung.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
    FROM kampung
      LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
      LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
      LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
      LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
      LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
    WHERE kabupaten.id_kabupaten = {$kabupatenForm}
      AND puskesmas.id_puskesmas = {$puskesmasForm}
    GROUP BY kampung.id_kampung
    ORDER BY kampung.id_kampung

    ");



            $query7 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
    puskesmas.nama_puskesmas as puskesmas,
    kampung.nama_kampung as kampung,
    SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
    SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
    SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
    ROUND((ROUND(AVG(kampung.sd_2_L + kampung.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
  FROM kampung
    LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
    LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
    LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
    LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
    LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
  WHERE kabupaten.id_kabupaten = {$kabupatenForm}
    AND puskesmas.id_puskesmas = {$puskesmasForm}
  GROUP BY kampung.id_kampung
  ORDER BY kampung.id_kampung

  ");



            $query8 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.sd_2_L + kampung.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query9 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.sd_2_L + kampung.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");




            $query10 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
        ROUND((ROUND(AVG(kampung.sd_2_L + kampung.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
      FROM kampung
        LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
        LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
        LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
        LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
        LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
      WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        AND puskesmas.id_puskesmas = {$puskesmasForm}
      GROUP BY kampung.id_kampung
      ORDER BY kampung.id_kampung

      ");




            $query11 = DB::select("
      SELECT kabupaten.nama_kabupaten as kabupaten,
      puskesmas.nama_puskesmas as puskesmas,
      kampung.nama_kampung as kampung,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
      ROUND((ROUND(AVG(kampung.sd_2_L + kampung.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
    FROM kampung
      LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
      LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
      LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
      LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
      LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
    WHERE kabupaten.id_kabupaten = {$kabupatenForm}
      AND puskesmas.id_puskesmas = {$puskesmasForm}
    GROUP BY kampung.id_kampung
    ORDER BY kampung.id_kampung

    ");



            $query12 = DB::select("
      SELECT kabupaten.nama_kabupaten as kabupaten,
      puskesmas.nama_puskesmas as puskesmas,
      kampung.nama_kampung as kampung,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
      ROUND((ROUND(AVG(kampung.sd_2_L + kampung.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
    FROM kampung
      LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
      LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
      LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
      LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
      LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
    WHERE kabupaten.id_kabupaten = {$kabupatenForm}
      AND puskesmas.id_puskesmas = {$puskesmasForm}
    GROUP BY kampung.id_kampung
    ORDER BY kampung.id_kampung

    ");




        }
        elseif ($antigenForm==17 || $antigenForm==18) {
            $query = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.sd_5_L + kampung.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung
        ");



            $query1 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.sd_5_L + kampung.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query2 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.sd_5_L + kampung.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query3 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
        ROUND((ROUND(AVG(kampung.sd_5_L + kampung.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
      FROM kampung
        LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
        LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
        LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
        LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
        LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
      WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        AND puskesmas.id_puskesmas = {$puskesmasForm}
      GROUP BY kampung.id_kampung
      ORDER BY kampung.id_kampung

      ");



            $query4 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.sd_5_L + kampung.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query5 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
        ROUND((ROUND(AVG(kampung.sd_5_L + kampung.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
      FROM kampung
        LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
        LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
        LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
        LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
        LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
      WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        AND puskesmas.id_puskesmas = {$puskesmasForm}
      GROUP BY kampung.id_kampung
      ORDER BY kampung.id_kampung

      ");



            $query6 = DB::select("
      SELECT kabupaten.nama_kabupaten as kabupaten,
      puskesmas.nama_puskesmas as puskesmas,
      kampung.nama_kampung as kampung,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
      ROUND((ROUND(AVG(kampung.sd_5_L + kampung.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
    FROM kampung
      LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
      LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
      LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
      LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
      LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
    WHERE kabupaten.id_kabupaten = {$kabupatenForm}
      AND puskesmas.id_puskesmas = {$puskesmasForm}
    GROUP BY kampung.id_kampung
    ORDER BY kampung.id_kampung

    ");



            $query7 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
    puskesmas.nama_puskesmas as puskesmas,
    kampung.nama_kampung as kampung,
    SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
    SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
    SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
    ROUND((ROUND(AVG(kampung.sd_5_L + kampung.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
  FROM kampung
    LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
    LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
    LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
    LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
    LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
  WHERE kabupaten.id_kabupaten = {$kabupatenForm}
    AND puskesmas.id_puskesmas = {$puskesmasForm}
  GROUP BY kampung.id_kampung
  ORDER BY kampung.id_kampung

  ");



            $query8 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.sd_5_L + kampung.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query9 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.sd_5_L + kampung.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");




            $query10 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
        ROUND((ROUND(AVG(kampung.sd_5_L + kampung.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
      FROM kampung
        LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
        LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
        LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
        LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
        LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
      WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        AND puskesmas.id_puskesmas = {$puskesmasForm}
      GROUP BY kampung.id_kampung
      ORDER BY kampung.id_kampung

      ");




            $query11 = DB::select("
      SELECT kabupaten.nama_kabupaten as kabupaten,
      puskesmas.nama_puskesmas as puskesmas,
      kampung.nama_kampung as kampung,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
      ROUND((ROUND(AVG(kampung.sd_5_L + kampung.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
    FROM kampung
      LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
      LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
      LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
      LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
      LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
    WHERE kabupaten.id_kabupaten = {$kabupatenForm}
      AND puskesmas.id_puskesmas = {$puskesmasForm}
    GROUP BY kampung.id_kampung
    ORDER BY kampung.id_kampung

    ");



            $query12 = DB::select("
      SELECT kabupaten.nama_kabupaten as kabupaten,
      puskesmas.nama_puskesmas as puskesmas,
      kampung.nama_kampung as kampung,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
      ROUND((ROUND(AVG(kampung.sd_5_L + kampung.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
    FROM kampung
      LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
      LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
      LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
      LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
      LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
    WHERE kabupaten.id_kabupaten = {$kabupatenForm}
      AND puskesmas.id_puskesmas = {$puskesmasForm}
    GROUP BY kampung.id_kampung
    ORDER BY kampung.id_kampung

    ");




        }
        elseif ($antigenForm==19) {
            $query = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.sd_6_L + kampung.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung
        ");



            $query1 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.sd_6_L + kampung.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query2 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.sd_6_L + kampung.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query3 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
        ROUND((ROUND(AVG(kampung.sd_6_L + kampung.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
      FROM kampung
        LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
        LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
        LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
        LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
        LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
      WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        AND puskesmas.id_puskesmas = {$puskesmasForm}
      GROUP BY kampung.id_kampung
      ORDER BY kampung.id_kampung

      ");



            $query4 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.sd_6_L + kampung.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query5 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
        ROUND((ROUND(AVG(kampung.sd_6_L + kampung.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
      FROM kampung
        LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
        LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
        LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
        LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
        LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
      WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        AND puskesmas.id_puskesmas = {$puskesmasForm}
      GROUP BY kampung.id_kampung
      ORDER BY kampung.id_kampung

      ");



            $query6 = DB::select("
      SELECT kabupaten.nama_kabupaten as kabupaten,
      puskesmas.nama_puskesmas as puskesmas,
      kampung.nama_kampung as kampung,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
      ROUND((ROUND(AVG(kampung.sd_6_L + kampung.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
    FROM kampung
      LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
      LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
      LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
      LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
      LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
    WHERE kabupaten.id_kabupaten = {$kabupatenForm}
      AND puskesmas.id_puskesmas = {$puskesmasForm}
    GROUP BY kampung.id_kampung
    ORDER BY kampung.id_kampung

    ");



            $query7 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
    puskesmas.nama_puskesmas as puskesmas,
    kampung.nama_kampung as kampung,
    SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
    SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
    SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
    ROUND((ROUND(AVG(kampung.sd_6_L + kampung.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
  FROM kampung
    LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
    LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
    LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
    LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
    LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
  WHERE kabupaten.id_kabupaten = {$kabupatenForm}
    AND puskesmas.id_puskesmas = {$puskesmasForm}
  GROUP BY kampung.id_kampung
  ORDER BY kampung.id_kampung

  ");



            $query8 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.sd_6_L + kampung.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query9 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.sd_6_L + kampung.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");




            $query10 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
        ROUND((ROUND(AVG(kampung.sd_6_L + kampung.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
      FROM kampung
        LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
        LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
        LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
        LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
        LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
      WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        AND puskesmas.id_puskesmas = {$puskesmasForm}
      GROUP BY kampung.id_kampung
      ORDER BY kampung.id_kampung

      ");




            $query11 = DB::select("
      SELECT kabupaten.nama_kabupaten as kabupaten,
      puskesmas.nama_puskesmas as puskesmas,
      kampung.nama_kampung as kampung,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
      ROUND((ROUND(AVG(kampung.sd_6_L + kampung.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
    FROM kampung
      LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
      LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
      LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
      LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
      LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
    WHERE kabupaten.id_kabupaten = {$kabupatenForm}
      AND puskesmas.id_puskesmas = {$puskesmasForm}
    GROUP BY kampung.id_kampung
    ORDER BY kampung.id_kampung

    ");



            $query12 = DB::select("
      SELECT kabupaten.nama_kabupaten as kabupaten,
      puskesmas.nama_puskesmas as puskesmas,
      kampung.nama_kampung as kampung,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
      ROUND((ROUND(AVG(kampung.sd_6_L + kampung.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
    FROM kampung
      LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
      LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
      LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
      LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
      LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
    WHERE kabupaten.id_kabupaten = {$kabupatenForm}
      AND puskesmas.id_puskesmas = {$puskesmasForm}
    GROUP BY kampung.id_kampung
    ORDER BY kampung.id_kampung

    ");




        }
        else {
            $query = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.surviving_infant_L + kampung.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung
        ");



            $query1 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.surviving_infant_L + kampung.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query2 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.surviving_infant_L + kampung.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query3 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
        ROUND((ROUND(AVG(kampung.surviving_infant_L + kampung.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
      FROM kampung
        LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
        LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
        LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
        LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
        LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
      WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        AND puskesmas.id_puskesmas = {$puskesmasForm}
      GROUP BY kampung.id_kampung
      ORDER BY kampung.id_kampung

      ");



            $query4 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.surviving_infant_L + kampung.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query5 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
        ROUND((ROUND(AVG(kampung.surviving_infant_L + kampung.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
      FROM kampung
        LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
        LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
        LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
        LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
        LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
      WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        AND puskesmas.id_puskesmas = {$puskesmasForm}
      GROUP BY kampung.id_kampung
      ORDER BY kampung.id_kampung

      ");



            $query6 = DB::select("
      SELECT kabupaten.nama_kabupaten as kabupaten,
      puskesmas.nama_puskesmas as puskesmas,
      kampung.nama_kampung as kampung,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
      ROUND((ROUND(AVG(kampung.surviving_infant_L + kampung.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
    FROM kampung
      LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
      LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
      LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
      LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
      LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
    WHERE kabupaten.id_kabupaten = {$kabupatenForm}
      AND puskesmas.id_puskesmas = {$puskesmasForm}
    GROUP BY kampung.id_kampung
    ORDER BY kampung.id_kampung

    ");



            $query7 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
    puskesmas.nama_puskesmas as puskesmas,
    kampung.nama_kampung as kampung,
    SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
    SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
    SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
    ROUND((ROUND(AVG(kampung.surviving_infant_L + kampung.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
  FROM kampung
    LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
    LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
    LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
    LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
    LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
  WHERE kabupaten.id_kabupaten = {$kabupatenForm}
    AND puskesmas.id_puskesmas = {$puskesmasForm}
  GROUP BY kampung.id_kampung
  ORDER BY kampung.id_kampung

  ");



            $query8 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.surviving_infant_L + kampung.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");



            $query9 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(kampung.surviving_infant_L + kampung.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");




            $query10 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
        SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
        ROUND((ROUND(AVG(kampung.surviving_infant_L + kampung.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
      FROM kampung
        LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
        LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
        LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
        LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
        LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
      WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        AND puskesmas.id_puskesmas = {$puskesmasForm}
      GROUP BY kampung.id_kampung
      ORDER BY kampung.id_kampung

      ");




            $query11 = DB::select("
      SELECT kabupaten.nama_kabupaten as kabupaten,
      puskesmas.nama_puskesmas as puskesmas,
      kampung.nama_kampung as kampung,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
      ROUND((ROUND(AVG(kampung.surviving_infant_L + kampung.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
    FROM kampung
      LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
      LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
      LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
      LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
      LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
    WHERE kabupaten.id_kabupaten = {$kabupatenForm}
      AND puskesmas.id_puskesmas = {$puskesmasForm}
    GROUP BY kampung.id_kampung
    ORDER BY kampung.id_kampung

    ");



            $query12 = DB::select("
      SELECT kabupaten.nama_kabupaten as kabupaten,
      puskesmas.nama_puskesmas as puskesmas,
      kampung.nama_kampung as kampung,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
      SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
      ROUND((ROUND(AVG(kampung.surviving_infant_L + kampung.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
    FROM kampung
      LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
      LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
      LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
      LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
      LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
    WHERE kabupaten.id_kabupaten = {$kabupatenForm}
      AND puskesmas.id_puskesmas = {$puskesmasForm}
    GROUP BY kampung.id_kampung
    ORDER BY kampung.id_kampung

    ");

        }

        return view('kabupaten.capaian.capaianKampung', ['query' => $query, 'query1' => $query1, 'query2' => $query2, 'query3' => $query3, 'query4' => $query4, 'query5' => $query5, 'query6' => $query6, 'query7' => $query7, 'query8' => $query8, 'query9' => $query9, 'query10' => $query10, 'query11' => $query11, 'query12' => $query12, 'kabupatens' => $kabupatens, 'puskesmas' => $puskesmas, 'antigens' => $antigens, 'kabupatenForm' => $kabupatenForm, 'puskesmasForm' => $puskesmasForm, 'antigenForm' => $antigenForm, 'tahunForm' => $tahunForm]);
    }

    public function capaianAntigenPuskesmas(Request $request) {
        $tahunForm = $request->tahunForm ?: 2020;
        $kabupatenForm = $request->kabupatenForm ?: 1;
        $antigenForm = $request->antigenForm ?: 1;

        $antigens = (new AntigenModel)->getListAntigen();
        $kabupatens = (new KabupatenModel)->getListKabupaten();

        if ($antigenForm==1 || $antigenForm==2 || $antigenForm==3) {
            $query = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.bayi_lahir_L+ puskesmas.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query1 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.bayi_lahir_L+ puskesmas.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");




            $query2 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.bayi_lahir_L+ puskesmas.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query3 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.bayi_lahir_L+ puskesmas.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query4 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.bayi_lahir_L+ puskesmas.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query5 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.bayi_lahir_L+ puskesmas.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query6 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.bayi_lahir_L+ puskesmas.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query7 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.bayi_lahir_L+ puskesmas.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query8 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.bayi_lahir_L+ puskesmas.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query9 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.bayi_lahir_L+ puskesmas.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query10 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.bayi_lahir_L+ puskesmas.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query11 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.bayi_lahir_L+ puskesmas.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query12 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.bayi_lahir_L+ puskesmas.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");




        }
        elseif ($antigenForm==12 || $antigenForm==13) {
            $query = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.baduta_L+ puskesmas.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query1 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.baduta_L+ puskesmas.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");




            $query2 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.baduta_L+ puskesmas.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query3 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.baduta_L+ puskesmas.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query4 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.baduta_L+ puskesmas.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query5 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.baduta_L+ puskesmas.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query6 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.baduta_L+ puskesmas.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query7 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.baduta_L+ puskesmas.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query8 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.baduta_L+ puskesmas.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query9 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.baduta_L+ puskesmas.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query10 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.baduta_L+ puskesmas.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query11 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.baduta_L+ puskesmas.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query12 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.baduta_L+ puskesmas.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");




        }
        elseif ($antigenForm==14 || $antigenForm==15) {
            $query = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_1_L+ puskesmas.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query1 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_1_L+ puskesmas.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");




            $query2 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_1_L+ puskesmas.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query3 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_1_L+ puskesmas.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query4 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_1_L+ puskesmas.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query5 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_1_L+ puskesmas.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query6 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_1_L+ puskesmas.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query7 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_1_L+ puskesmas.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query8 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_1_L+ puskesmas.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query9 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_1_L+ puskesmas.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query10 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_1_L+ puskesmas.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query11 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_1_L+ puskesmas.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query12 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_1_L+ puskesmas.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");




        }
        elseif ($antigenForm==16) {
            $query = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_2_L+ puskesmas.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query1 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_2_L+ puskesmas.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");




            $query2 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_2_L+ puskesmas.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query3 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_2_L+ puskesmas.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query4 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_2_L+ puskesmas.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query5 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_2_L+ puskesmas.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query6 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_2_L+ puskesmas.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query7 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_2_L+ puskesmas.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query8 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_2_L+ puskesmas.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query9 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_2_L+ puskesmas.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query10 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_2_L+ puskesmas.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query11 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_2_L+ puskesmas.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query12 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_2_L+ puskesmas.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");




        }
        elseif ($antigenForm==17 || $antigenForm==18) {
            $query = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_5_L+ puskesmas.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query1 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_5_L+ puskesmas.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");




            $query2 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_5_L+ puskesmas.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query3 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_5_L+ puskesmas.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query4 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_5_L+ puskesmas.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query5 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_5_L+ puskesmas.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query6 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_5_L+ puskesmas.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query7 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_5_L+ puskesmas.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query8 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_5_L+ puskesmas.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query9 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_5_L+ puskesmas.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query10 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_5_L+ puskesmas.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query11 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_5_L+ puskesmas.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query12 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_5_L+ puskesmas.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");




        }
        elseif ($antigenForm==19) {
            $query = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_6_L+ puskesmas.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query1 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_6_L+ puskesmas.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");




            $query2 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_6_L+ puskesmas.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query3 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_6_L+ puskesmas.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query4 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_6_L+ puskesmas.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query5 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_6_L+ puskesmas.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query6 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_6_L+ puskesmas.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query7 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_6_L+ puskesmas.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query8 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_6_L+ puskesmas.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query9 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_6_L+ puskesmas.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query10 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_6_L+ puskesmas.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query11 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_6_L+ puskesmas.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query12 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.sd_6_L+ puskesmas.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");




        }
        else {
            $query = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.surviving_infant_L+ puskesmas.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query1 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.surviving_infant_L+ puskesmas.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");




            $query2 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.surviving_infant_L+ puskesmas.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query3 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.surviving_infant_L+ puskesmas.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query4 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.surviving_infant_L+ puskesmas.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query5 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.surviving_infant_L+ puskesmas.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query6 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.surviving_infant_L+ puskesmas.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query7 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.surviving_infant_L+ puskesmas.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query8 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.surviving_infant_L+ puskesmas.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query9 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.surviving_infant_L+ puskesmas.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query10 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.surviving_infant_L+ puskesmas.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query11 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.surviving_infant_L+ puskesmas.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");



            $query12 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP,
          SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL,
          ROUND((ROUND(AVG(puskesmas.surviving_infant_L+ puskesmas.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.nama_puskesmas
        ORDER BY puskesmas.id_puskesmas
        ");


        }


        return view('kabupaten.capaian.capaianPuskesmas', ['kabupatens' => $kabupatens, 'antigens' => $antigens, 'kabupatenForm' => $kabupatenForm, 'antigenForm' => $antigenForm, 'tahunForm' => $tahunForm, 'query' => $query, 'query1' => $query1, 'query2' => $query2, 'query3' => $query3, 'query4' => $query4, 'query5' => $query5, 'query6' => $query6, 'query7' => $query7, 'query8' => $query8, 'query9' => $query9, 'query10' => $query10, 'query11' => $query11, 'query12' => $query12]);
    }

    public function capaianIDL(Request $request) {
        $tahunForm = $request->tahunForm ?: 2020;
        $kabupatenForm = $request->kabupatenForm ?: 1;
        $kabupatens = (new KabupatenModel)->getListKabupaten();

        $query = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN data_individu.idl = 1 AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END) as idl,
          (puskesmas.surviving_infant_L + puskesmas.surviving_infant_P) as sasaran
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.id_puskesmas
        ORDER BY puskesmas.id_puskesmas
    ");

        $query1 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END) as idl,
          ROUND((puskesmas.surviving_infant_L + puskesmas.surviving_infant_P)*0.2) as sasaran
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.id_puskesmas
        ORDER BY puskesmas.id_puskesmas
    ");

        $query2 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03 OR MONTH(data_individu.tanggal_idl) = 04 OR MONTH(data_individu.tanggal_idl) = 05 OR MONTH(data_individu.tanggal_idl) = 06) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END) as idl,
          ROUND((puskesmas.surviving_infant_L + puskesmas.surviving_infant_P)*0.4) as sasaran
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.id_puskesmas
        ORDER BY puskesmas.id_puskesmas
    ");

        $query3 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03 OR MONTH(data_individu.tanggal_idl) = 04 OR MONTH(data_individu.tanggal_idl) = 05 OR MONTH(data_individu.tanggal_idl) = 06 OR MONTH(data_individu.tanggal_idl) = 07 OR MONTH(data_individu.tanggal_idl) = 08 OR MONTH(data_individu.tanggal_idl) = 09) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END) as idl,
          ROUND((puskesmas.surviving_infant_L + puskesmas.surviving_infant_P)*0.6) as sasaran
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.id_puskesmas
        ORDER BY puskesmas.id_puskesmas
    ");

        $query4 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN data_individu.idl = 1 AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END) as idl,
          ROUND((puskesmas.surviving_infant_L + puskesmas.surviving_infant_P)*0.8) as sasaran
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.id_puskesmas
        ORDER BY puskesmas.id_puskesmas
    ");

        return view('kabupaten.capaian.capaianIDL', ['query' => $query, 'query1' => $query1, 'query2' => $query2, 'query3' => $query3, 'query4' => $query4, 'kabupatenForm' => $kabupatenForm, 'tahunForm' => $tahunForm, 'kabupatens' => $kabupatens]);
    }

    public function capaianIRL(Request $request) {
        $tahunForm = $request->tahunForm ?: 2020;
        $kabupatenForm = $request->kabupatenForm ?: 1;
        $kabupatens = (new KabupatenModel)->getListKabupaten();

        $query = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN data_individu.irl = 1 AND YEAR(data_individu.tanggal_irl) = {$tahunForm} THEN 1 ELSE 0 END) as 'irl'
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.id_puskesmas
        ORDER BY puskesmas.id_puskesmas
    ");

        $query1 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN data_individu.irl = 1 AND (MONTH(data_individu.tanggal_irl) = 01 OR MONTH(data_individu.tanggal_irl) = 02 OR MONTH(data_individu.tanggal_irl) = 03) AND YEAR(data_individu.tanggal_irl) = {$tahunForm} THEN 1 ELSE 0 END) as irl
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.id_puskesmas
        ORDER BY puskesmas.id_puskesmas
    ");

        $query2 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN data_individu.irl = 1 AND (MONTH(data_individu.tanggal_irl) = 01 OR MONTH(data_individu.tanggal_irl) = 02 OR MONTH(data_individu.tanggal_irl) = 03 OR MONTH(data_individu.tanggal_irl) = 04 OR MONTH(data_individu.tanggal_irl) = 05 OR MONTH(data_individu.tanggal_irl) = 06) AND YEAR(data_individu.tanggal_irl) = {$tahunForm} THEN 1 ELSE 0 END) as irl
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.id_puskesmas
        ORDER BY puskesmas.id_puskesmas
    ");

        $query3 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN data_individu.irl = 1 AND (MONTH(data_individu.tanggal_irl) = 01 OR MONTH(data_individu.tanggal_irl) = 02 OR MONTH(data_individu.tanggal_irl) = 03 OR MONTH(data_individu.tanggal_irl) = 04 OR MONTH(data_individu.tanggal_irl) = 05 OR MONTH(data_individu.tanggal_irl) = 06 OR MONTH(data_individu.tanggal_irl) = 07 OR MONTH(data_individu.tanggal_irl) = 08 OR MONTH(data_individu.tanggal_irl) = 09) AND YEAR(data_individu.tanggal_irl) = {$tahunForm} THEN 1 ELSE 0 END) as irl
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.id_puskesmas
        ORDER BY puskesmas.id_puskesmas
    ");

        $query4 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          SUM(CASE WHEN data_individu.irl = 1 AND YEAR(data_individu.tanggal_irl) = {$tahunForm} THEN 1 ELSE 0 END) as irl
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.id_puskesmas
        ORDER BY puskesmas.id_puskesmas
    ");

        return view('kabupaten.capaian.capaianIRL', ['query' => $query, 'query1' => $query1, 'query2' => $query2, 'query3' => $query3, 'query4' => $query4, 'kabupatenForm' => $kabupatenForm, 'tahunForm' => $tahunForm, 'kabupatens' => $kabupatens]);

    }

    public function capaianT (Request $request) {
        $tahunForm = $request->tahunForm ?: 2020;
        $kabupatenForm = $request->kabupatenForm ?: 1;
        $kabupatens = (new KabupatenModel)->getListKabupaten();

        $query = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
        ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil+puskesmas.wus_hamil)*100) as t1_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_hamil)*100) as t1_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil)*100) as t1_tidak_hamil,

        ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil+puskesmas.wus_hamil)*100) as t2_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_hamil)*100) as t2_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil)*100) as t2_tidak_hamil,

        ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil+puskesmas.wus_hamil)*100) as t3_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_hamil)*100) as t3_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil)*100) as t3_tidak_hamil,

        ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil+puskesmas.wus_hamil)*100) as t4_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_hamil)*100) as t4_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil)*100) as t4_tidak_hamil,

        ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil+puskesmas.wus_hamil)*100) as t5_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_hamil)*100) as t5_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil)*100) as t5_tidak_hamil

        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.id_puskesmas
        ORDER BY puskesmas.id_puskesmas
    ");



        $query1 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
        ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil+puskesmas.wus_hamil)*100) as t1_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_hamil)*100) as t1_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil)*100) as t1_tidak_hamil,

        ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil+puskesmas.wus_hamil)*100) as t2_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_hamil)*100) as t2_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil)*100) as t2_tidak_hamil,

        ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil+puskesmas.wus_hamil)*100) as t3_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_hamil)*100) as t3_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil)*100) as t3_tidak_hamil,

        ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil+puskesmas.wus_hamil)*100) as t4_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_hamil)*100) as t4_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil)*100) as t4_tidak_hamil,

        ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil+puskesmas.wus_hamil)*100) as t5_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_hamil)*100) as t5_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil)*100) as t5_tidak_hamil

        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.id_puskesmas
        ORDER BY puskesmas.id_puskesmas
    ");



        $query2 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
        ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil+puskesmas.wus_hamil)*100) as t1_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_hamil)*100) as t1_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil)*100) as t1_tidak_hamil,

        ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil+puskesmas.wus_hamil)*100) as t2_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_hamil)*100) as t2_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil)*100) as t2_tidak_hamil,

        ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil+puskesmas.wus_hamil)*100) as t3_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_hamil)*100) as t3_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil)*100) as t3_tidak_hamil,

        ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil+puskesmas.wus_hamil)*100) as t4_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_hamil)*100) as t4_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil)*100) as t4_tidak_hamil,

        ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil+puskesmas.wus_hamil)*100) as t5_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_hamil)*100) as t5_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(puskesmas.wus_tidak_hamil)*100) as t5_tidak_hamil

        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
        GROUP BY puskesmas.id_puskesmas
        ORDER BY puskesmas.id_puskesmas
    ");




        return view('kabupaten.capaian.capaianT', ['query' => $query, 'query1' => $query1, 'query2' => $query2, 'kabupatenForm' => $kabupatenForm, 'tahunForm' => $tahunForm, 'kabupatens' => $kabupatens]);
    }
}
