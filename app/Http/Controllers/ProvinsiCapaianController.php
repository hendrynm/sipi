<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvinsiCapaianController extends Controller
{
    public function capaianAntigenKabupaten()
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
}
