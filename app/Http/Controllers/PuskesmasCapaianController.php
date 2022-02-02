<?php

namespace App\Http\Controllers;

use App\Models\AntigenModel;
use App\Models\KabupatenModel;
use App\Models\PuskesmasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PuskesmasCapaianController extends Controller
{
    public function puskesmas() {
        return redirect('/puskesmas/dashboard');
    }

    public function capaianAntigenPuskesmas(Request $request) {

        $tahunForm = $request->tahunForm ?: 2020;
        $kabupatenForm = $request->kabupatenForm ?: 1;
        $puskesmasForm = $request->puskesmasForm ?: 1;

        $puskesmas = (new PuskesmasModel())->getListPuskesmas();
        $puskesmas = [$puskesmas[$puskesmasForm]];
        $kabupatens = (new KabupatenModel)->getListKabupaten();


        $query = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (puskesmas.bayi_lahir_L+puskesmas.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (puskesmas.baduta_L+puskesmas.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (puskesmas.sd_1_L+puskesmas.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (puskesmas.sd_2_L+puskesmas.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (puskesmas.sd_5_L+puskesmas.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (puskesmas.sd_6_L+puskesmas.sd_6_P)
              ELSE (puskesmas.surviving_infant_L+puskesmas.surviving_infant_P) END)*0.95) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY antigen.id_antigen
        ORDER BY puskesmas.id_puskesmas
    ");

        $query1 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (puskesmas.bayi_lahir_L+puskesmas.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (puskesmas.baduta_L+puskesmas.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (puskesmas.sd_1_L+puskesmas.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (puskesmas.sd_2_L+puskesmas.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (puskesmas.sd_5_L+puskesmas.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (puskesmas.sd_6_L+puskesmas.sd_6_P)
              ELSE (puskesmas.surviving_infant_L+puskesmas.surviving_infant_P) END)*0.95/12) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY antigen.id_antigen
        ORDER BY puskesmas.id_puskesmas
    ");

        $query2 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (puskesmas.bayi_lahir_L+puskesmas.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (puskesmas.baduta_L+puskesmas.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (puskesmas.sd_1_L+puskesmas.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (puskesmas.sd_2_L+puskesmas.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (puskesmas.sd_5_L+puskesmas.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (puskesmas.sd_6_L+puskesmas.sd_6_P)
              ELSE (puskesmas.surviving_infant_L+puskesmas.surviving_infant_P) END)*0.95/12) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY antigen.id_antigen
        ORDER BY puskesmas.id_puskesmas
    ");


        $query3 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (puskesmas.bayi_lahir_L+puskesmas.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (puskesmas.baduta_L+puskesmas.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (puskesmas.sd_1_L+puskesmas.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (puskesmas.sd_2_L+puskesmas.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (puskesmas.sd_5_L+puskesmas.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (puskesmas.sd_6_L+puskesmas.sd_6_P)
              ELSE (puskesmas.surviving_infant_L+puskesmas.surviving_infant_P) END)*0.95/12) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY antigen.id_antigen
        ORDER BY puskesmas.id_puskesmas
    ");


        $query4 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (puskesmas.bayi_lahir_L+puskesmas.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (puskesmas.baduta_L+puskesmas.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (puskesmas.sd_1_L+puskesmas.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (puskesmas.sd_2_L+puskesmas.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (puskesmas.sd_5_L+puskesmas.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (puskesmas.sd_6_L+puskesmas.sd_6_P)
              ELSE (puskesmas.surviving_infant_L+puskesmas.surviving_infant_P) END)*0.95/12) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY antigen.id_antigen
        ORDER BY puskesmas.id_puskesmas
    ");


        $query5 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (puskesmas.bayi_lahir_L+puskesmas.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (puskesmas.baduta_L+puskesmas.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (puskesmas.sd_1_L+puskesmas.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (puskesmas.sd_2_L+puskesmas.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (puskesmas.sd_5_L+puskesmas.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (puskesmas.sd_6_L+puskesmas.sd_6_P)
              ELSE (puskesmas.surviving_infant_L+puskesmas.surviving_infant_P) END)*0.95/12) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY antigen.id_antigen
        ORDER BY puskesmas.id_puskesmas
    ");


        $query6 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (puskesmas.bayi_lahir_L+puskesmas.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (puskesmas.baduta_L+puskesmas.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (puskesmas.sd_1_L+puskesmas.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (puskesmas.sd_2_L+puskesmas.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (puskesmas.sd_5_L+puskesmas.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (puskesmas.sd_6_L+puskesmas.sd_6_P)
              ELSE (puskesmas.surviving_infant_L+puskesmas.surviving_infant_P) END)*0.95/12) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY antigen.id_antigen
        ORDER BY puskesmas.id_puskesmas
    ");


        $query7 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (puskesmas.bayi_lahir_L+puskesmas.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (puskesmas.baduta_L+puskesmas.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (puskesmas.sd_1_L+puskesmas.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (puskesmas.sd_2_L+puskesmas.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (puskesmas.sd_5_L+puskesmas.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (puskesmas.sd_6_L+puskesmas.sd_6_P)
              ELSE (puskesmas.surviving_infant_L+puskesmas.surviving_infant_P) END)*0.95/12) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY antigen.id_antigen
        ORDER BY puskesmas.id_puskesmas
    ");


        $query8 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (puskesmas.bayi_lahir_L+puskesmas.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (puskesmas.baduta_L+puskesmas.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (puskesmas.sd_1_L+puskesmas.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (puskesmas.sd_2_L+puskesmas.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (puskesmas.sd_5_L+puskesmas.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (puskesmas.sd_6_L+puskesmas.sd_6_P)
              ELSE (puskesmas.surviving_infant_L+puskesmas.surviving_infant_P) END)*0.95/12) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY antigen.id_antigen
        ORDER BY puskesmas.id_puskesmas
    ");


        $query9 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 9 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (puskesmas.bayi_lahir_L+puskesmas.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (puskesmas.baduta_L+puskesmas.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (puskesmas.sd_1_L+puskesmas.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (puskesmas.sd_2_L+puskesmas.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (puskesmas.sd_5_L+puskesmas.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (puskesmas.sd_6_L+puskesmas.sd_6_P)
              ELSE (puskesmas.surviving_infant_L+puskesmas.surviving_infant_P) END)*0.95/12) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY antigen.id_antigen
        ORDER BY puskesmas.id_puskesmas
    ");


        $query10 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (puskesmas.bayi_lahir_L+puskesmas.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (puskesmas.baduta_L+puskesmas.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (puskesmas.sd_1_L+puskesmas.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (puskesmas.sd_2_L+puskesmas.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (puskesmas.sd_5_L+puskesmas.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (puskesmas.sd_6_L+puskesmas.sd_6_P)
              ELSE (puskesmas.surviving_infant_L+puskesmas.surviving_infant_P) END)*0.95/12) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY antigen.id_antigen
        ORDER BY puskesmas.id_puskesmas
    ");


        $query11 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (puskesmas.bayi_lahir_L+puskesmas.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (puskesmas.baduta_L+puskesmas.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (puskesmas.sd_1_L+puskesmas.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (puskesmas.sd_2_L+puskesmas.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (puskesmas.sd_5_L+puskesmas.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (puskesmas.sd_6_L+puskesmas.sd_6_P)
              ELSE (puskesmas.surviving_infant_L+puskesmas.surviving_infant_P) END)*0.95/12) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY antigen.id_antigen
        ORDER BY puskesmas.id_puskesmas
    ");


        $query12 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          antigen.nama_antigen as antigen,
          SUM(CASE WHEN imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END) as jumlah,
          ROUND(AVG(CASE WHEN antigen.id_antigen=1 OR antigen.id_antigen=2 OR antigen.id_antigen=3 THEN (puskesmas.bayi_lahir_L+puskesmas.bayi_lahir_P)
              WHEN antigen.id_antigen=12 OR antigen.id_antigen=13 THEN (puskesmas.baduta_L+puskesmas.baduta_P)
              WHEN antigen.id_antigen=14 OR antigen.id_antigen=15 THEN (puskesmas.sd_1_L+puskesmas.sd_1_P)
              WHEN antigen.id_antigen=16 THEN (puskesmas.sd_2_L+puskesmas.sd_2_P)
              WHEN antigen.id_antigen=17 OR antigen.id_antigen=18 THEN (puskesmas.sd_5_L+puskesmas.sd_5_P)
              WHEN antigen.id_antigen=19 THEN (puskesmas.sd_6_L+puskesmas.sd_6_P)
              ELSE (puskesmas.surviving_infant_L+puskesmas.surviving_infant_P) END)*0.95/12) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY antigen.id_antigen
        ORDER BY puskesmas.id_puskesmas
    ");


        return view('puskesmas.capaian.capaianPuskesmas', ['kabupatens' => $kabupatens, 'kabupatenForm' => $kabupatenForm, 'tahunForm' => $tahunForm, 'puskesmasForm' => $puskesmasForm, 'puskesmas' => $puskesmas, 'query' => $query, 'query1' => $query1, 'query2' => $query2, 'query3' => $query3, 'query4' => $query4, 'query5' => $query5, 'query6' => $query6, 'query7' => $query7, 'query8' => $query8, 'query9' => $query9, 'query10' => $query10, 'query11' => $query11, 'query12' => $query12]);
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

        return view('puskesmas.capaian.capaianKampung', ['query' => $query, 'query1' => $query1, 'query2' => $query2, 'query3' => $query3, 'query4' => $query4, 'query5' => $query5, 'query6' => $query6, 'query7' => $query7, 'query8' => $query8, 'query9' => $query9, 'query10' => $query10, 'query11' => $query11, 'query12' => $query12, 'kabupatens' => $kabupatens, 'puskesmas' => $puskesmas, 'antigens' => $antigens, 'kabupatenForm' => $kabupatenForm, 'puskesmasForm' => $puskesmasForm, 'antigenForm' => $antigenForm, 'tahunForm' => $tahunForm]);
    }

    public function capaianIDL(Request $request) {
        $tahunForm = $request->tahunForm ?: 2020;
        $kabupatenForm = $request->kabupatenForm ?: 1;
        $puskesmasForm = $request->puskesmasForm ?: 1;
        $antigenForm = $request->antigenForm ?: 1;

        $antigens = (new AntigenModel)->getListAntigen();
        $puskesmas = (new PuskesmasModel())->getListPuskesmas();
        $puskesmas = [$puskesmas[$puskesmasForm]];
        $kabupatens = (new KabupatenModel)->getListKabupaten();

        $query = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN data_individu.idl = 1 AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END) as idl,
          (kampung.surviving_infant_L + kampung.surviving_infant_P) as sasaran
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
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
          SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END) as idl,
          ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)*0.2) as sasaran
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
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
          SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03 OR MONTH(data_individu.tanggal_idl) = 04 OR MONTH(data_individu.tanggal_idl) = 05 OR MONTH(data_individu.tanggal_idl) = 06) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END) as idl,
          ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)*0.4) as sasaran
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
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
          SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03 OR MONTH(data_individu.tanggal_idl) = 04 OR MONTH(data_individu.tanggal_idl) = 05 OR MONTH(data_individu.tanggal_idl) = 06 OR MONTH(data_individu.tanggal_idl) = 07 OR MONTH(data_individu.tanggal_idl) = 08 OR MONTH(data_individu.tanggal_idl) = 09) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END) as idl,
          ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)*0.6) as sasaran
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
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
          SUM(CASE WHEN data_individu.idl = 1 AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END) as idl,
          ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)*0.8) as sasaran
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung
    ");

        return view('puskesmas.capaian.capaianIDL', ['query' => $query, 'query1' => $query1, 'query2' => $query2, 'query3' => $query3, 'query4' => $query4, 'kabupatens' => $kabupatens, 'puskesmas' => $puskesmas, 'antigens' => $antigens, 'kabupatenForm' => $kabupatenForm, 'puskesmasForm' => $puskesmasForm, 'antigenForm' => $antigenForm, 'tahunForm' => $tahunForm]);

    }

    public function capaianIRL(Request $request) {
        $tahunForm = $request->tahunForm ?: 2020;
        $kabupatenForm = $request->kabupatenForm ?: 1;
        $puskesmasForm = $request->puskesmasForm ?: 1;
        $antigenForm = $request->antigenForm ?: 1;

        $antigens = (new AntigenModel)->getListAntigen();
        $puskesmas = (new PuskesmasModel())->getListPuskesmas();
        $puskesmas = [$puskesmas[$puskesmasForm]];
        $kabupatens = (new KabupatenModel)->getListKabupaten();

        $query = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
          SUM(CASE WHEN data_individu.irl = 1 AND YEAR(data_individu.tanggal_irl) = {$tahunForm} THEN 1 ELSE 0 END) as irl
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
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
          SUM(CASE WHEN data_individu.irl = 1 AND (MONTH(data_individu.tanggal_irl) = 01 OR MONTH(data_individu.tanggal_irl) = 02 OR MONTH(data_individu.tanggal_irl) = 03) AND YEAR(data_individu.tanggal_irl) = {$tahunForm} THEN 1 ELSE 0 END) as irl
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
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
          SUM(CASE WHEN data_individu.irl = 1 AND (MONTH(data_individu.tanggal_irl) = 01 OR MONTH(data_individu.tanggal_irl) = 02 OR MONTH(data_individu.tanggal_irl) = 03 OR MONTH(data_individu.tanggal_irl) = 04 OR MONTH(data_individu.tanggal_irl) = 05 OR MONTH(data_individu.tanggal_irl) = 06) AND YEAR(data_individu.tanggal_irl) = {$tahunForm} THEN 1 ELSE 0 END) as irl
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
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
          SUM(CASE WHEN data_individu.irl = 1 AND (MONTH(data_individu.tanggal_irl) = 01 OR MONTH(data_individu.tanggal_irl) = 02 OR MONTH(data_individu.tanggal_irl) = 03 OR MONTH(data_individu.tanggal_irl) = 04 OR MONTH(data_individu.tanggal_irl) = 05 OR MONTH(data_individu.tanggal_irl) = 06 OR MONTH(data_individu.tanggal_irl) = 07 OR MONTH(data_individu.tanggal_irl) = 08 OR MONTH(data_individu.tanggal_irl) = 09) AND YEAR(data_individu.tanggal_irl) = {$tahunForm} THEN 1 ELSE 0 END) as irl
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
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
          SUM(CASE WHEN data_individu.irl = 1 AND YEAR(data_individu.tanggal_irl) = {$tahunForm} THEN 1 ELSE 0 END) as irl
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung
    ");


        return view('puskesmas.capaian.capaianIRL', ['query' => $query, 'query1' => $query1, 'query2' => $query2, 'query3' => $query3, 'query4' => $query4, 'kabupatens' => $kabupatens, 'puskesmas' => $puskesmas, 'antigens' => $antigens, 'kabupatenForm' => $kabupatenForm, 'puskesmasForm' => $puskesmasForm, 'antigenForm' => $antigenForm, 'tahunForm' => $tahunForm]);
    }

    public function capaianT(Request $request) {
        $tahunForm = $request->tahunForm ?: 2020;
        $kabupatenForm = $request->kabupatenForm ?: 1;
        $puskesmasForm = $request->puskesmasForm ?: 1;
        $antigenForm = $request->antigenForm ?: 1;

        $antigens = (new AntigenModel)->getListAntigen();
        $puskesmas = (new PuskesmasModel())->getListPuskesmas();
        $puskesmas = [$puskesmas[$puskesmasForm]];
        $kabupatens = (new KabupatenModel)->getListKabupaten();

        $query = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,
        ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil+kampung.wus_hamil)*100) as t1_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_hamil)*100) as t1_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil)*100) as t1_tidak_hamil,

        ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil+kampung.wus_hamil)*100) as t2_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_hamil)*100) as t2_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil)*100) as t2_tidak_hamil,

        ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil+kampung.wus_hamil)*100) as t3_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_hamil)*100) as t3_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil)*100) as t3_tidak_hamil,

        ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil+kampung.wus_hamil)*100) as t4_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_hamil)*100) as t4_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil)*100) as t4_tidak_hamil,

        ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil+kampung.wus_hamil)*100) as t5_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_hamil)*100) as t5_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil)*100) as t5_tidak_hamil

        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
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
        ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil+kampung.wus_hamil)*100) as t1_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_hamil)*100) as t1_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil)*100) as t1_tidak_hamil,

        ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil+kampung.wus_hamil)*100) as t2_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_hamil)*100) as t2_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil)*100) as t2_tidak_hamil,

        ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil+kampung.wus_hamil)*100) as t3_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_hamil)*100) as t3_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil)*100) as t3_tidak_hamil,

        ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil+kampung.wus_hamil)*100) as t4_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_hamil)*100) as t4_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil)*100) as t4_tidak_hamil,

        ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil+kampung.wus_hamil)*100) as t5_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_hamil)*100) as t5_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil)*100) as t5_tidak_hamil

        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
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
        ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil+kampung.wus_hamil)*100) as t1_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_hamil)*100) as t1_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil)*100) as t1_tidak_hamil,

        ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil+kampung.wus_hamil)*100) as t2_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_hamil)*100) as t2_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil)*100) as t2_tidak_hamil,

        ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil+kampung.wus_hamil)*100) as t3_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_hamil)*100) as t3_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil)*100) as t3_tidak_hamil,

        ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil+kampung.wus_hamil)*100) as t4_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_hamil)*100) as t4_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil)*100) as t4_tidak_hamil,

        ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil+kampung.wus_hamil)*100) as t5_total,
        ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_hamil)*100) as t5_hamil,
        ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kampung.wus_tidak_hamil)*100) as t5_tidak_hamil

        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung
    ");

        return view('puskesmas.capaian.capaianT', ['query' => $query, 'query1' => $query1, 'query2' => $query2, 'kabupatens' => $kabupatens, 'puskesmas' => $puskesmas, 'antigens' => $antigens, 'kabupatenForm' => $kabupatenForm, 'puskesmasForm' => $puskesmasForm, 'antigenForm' => $antigenForm, 'tahunForm' => $tahunForm]);

    }

    public function capaianUCI(Request $request) {
        $tahunForm = $request->tahunForm ?: 2020;
        $kabupatenForm = $request->kabupatenForm ?: 1;
        $puskesmasForm = $request->puskesmasForm ?: 1;

        $puskesmas = (new PuskesmasModel())->getListPuskesmas();
        $puskesmas = [$puskesmas[$puskesmasForm]];
        $kabupatens = (new KabupatenModel)->getListKabupaten();

        return view('puskesmas.capaian.capaianUCI', ['tahunForm' => $tahunForm, 'kabupatenForm' => $kabupatenForm, 'kabupatens' => $kabupatens, 'puskesmas' => $puskesmas, 'puskesmasForm' => $puskesmasForm]);
    }

    public function getListUciByQuarterId($year, $kabupaten, $puskesmas, $quarter) {
        $tahunForm = $year;
        $kabupatenForm = $kabupaten;
        $puskesmasForm = $puskesmas;
        $query = "";

        if ($quarter == 1) {
            $query = "SELECT kabupaten.nama_kabupaten as kabupaten,
            puskesmas.nama_puskesmas as puskesmas,
            kampung.nama_kampung as kampung,
            SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END) as idl,
            ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)) as sasaran,
            ROUND((SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END))/(ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)))*100) as ketercapaian,
            (CASE WHEN ((SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END))/(ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)))*100) > 20 THEN 'UCI' ELSE 'Non-UCI' END) as uci
                FROM kampung
                  LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
                  LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
                  LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten = {$kabupatenForm}
                  AND puskesmas.id_puskesmas = {$puskesmasForm}
                GROUP BY kampung.id_kampung
                ORDER BY kampung.id_kampung";
        }
        elseif  ($quarter == 2) {
            $query = "SELECT kabupaten.nama_kabupaten as kabupaten,
            puskesmas.nama_puskesmas as puskesmas,
            kampung.nama_kampung as kampung,
            SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03 OR MONTH(data_individu.tanggal_idl) = 04 OR MONTH(data_individu.tanggal_idl) = 05 OR MONTH(data_individu.tanggal_idl) = 06) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END) as idl,
            ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)) as sasaran,
            ROUND((SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03 OR MONTH(data_individu.tanggal_idl) = 04 OR MONTH(data_individu.tanggal_idl) = 05 OR MONTH(data_individu.tanggal_idl) = 06) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END))/(ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)))*100) as ketercapaian,
            (CASE WHEN ((SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03 OR MONTH(data_individu.tanggal_idl) = 04 OR MONTH(data_individu.tanggal_idl) = 05 OR MONTH(data_individu.tanggal_idl) = 06) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END))/(ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)))*100) > 40 THEN 'UCI' ELSE 'Non-UCI' END) as uci
                FROM kampung
                  LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
                  LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
                  LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten = {$kabupatenForm}
                  AND puskesmas.id_puskesmas = {$puskesmasForm}
                GROUP BY kampung.id_kampung
                ORDER BY kampung.id_kampung";
        }
        elseif ($quarter == 3) {
            $query = "SELECT kabupaten.nama_kabupaten as kabupaten,
	puskesmas.nama_puskesmas as puskesmas,
    kampung.nama_kampung as kampung,
    SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03 OR MONTH(data_individu.tanggal_idl) = 04 OR MONTH(data_individu.tanggal_idl) = 05 OR MONTH(data_individu.tanggal_idl) = 06 OR MONTH(data_individu.tanggal_idl) = 07 OR MONTH(data_individu.tanggal_idl) = 08 OR MONTH(data_individu.tanggal_idl) = 09) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END) as idl,
    ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)) as sasaran,
    ROUND((SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03 OR MONTH(data_individu.tanggal_idl) = 04 OR MONTH(data_individu.tanggal_idl) = 05 OR MONTH(data_individu.tanggal_idl) = 06 OR MONTH(data_individu.tanggal_idl) = 07 OR MONTH(data_individu.tanggal_idl) = 08 OR MONTH(data_individu.tanggal_idl) = 09) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END))/(ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)))*100) as ketercapaian,
    (CASE WHEN ((SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03 OR MONTH(data_individu.tanggal_idl) = 04 OR MONTH(data_individu.tanggal_idl) = 05 OR MONTH(data_individu.tanggal_idl) = 06 OR MONTH(data_individu.tanggal_idl) = 07 OR MONTH(data_individu.tanggal_idl) = 08 OR MONTH(data_individu.tanggal_idl) = 09) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END))/(ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)))*100) > 60 THEN 'UCI' ELSE 'Non-UCI' END) as uci
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung";
        }
        elseif ($quarter == 4) {
            $query = "SELECT kabupaten.nama_kabupaten as kabupaten,
	puskesmas.nama_puskesmas as puskesmas,
    kampung.nama_kampung as kampung,
    SUM(CASE WHEN data_individu.idl = 1 AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END) as idl,
    ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)) as sasaran,
    ROUND((SUM(CASE WHEN data_individu.idl = 1 AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END))/(ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)))*100) as ketercapaian,
    (CASE WHEN ((SUM(CASE WHEN data_individu.idl = 1 AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END))/(ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)))*100) > 80 THEN 'UCI' ELSE 'Non-UCI' END) as uci
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = {$kabupatenForm}
          AND puskesmas.id_puskesmas = {$puskesmasForm}
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung";
        }

        $data = DB::select($query);
        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);

    }

}
