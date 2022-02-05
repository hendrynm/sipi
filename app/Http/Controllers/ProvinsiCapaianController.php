<?php

namespace App\Http\Controllers;

use App\Models\AntigenModel;
use App\Models\KabupatenModel;
use App\Models\PuskesmasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ProvinsiCapaianController extends Controller
{
//    kerjaan naufal di bawah, naufal testing
    public function laporanBulanan(Request $request) {


      $tahunForm = $request->tahunForm ?: 2020;
      $kabupatenForm = $request->kabupatenForm ?: 1;
      $puskesmasForm = $request->puskesmasForm ?: 1;




    // bulan January
        $query = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,

          kampung.bayi_lahir_L as sasaran_bayi_lahir_L,
          kampung.bayi_lahir_P as sasaran_bayi_lahir_P,
          (kampung.bayi_lahir_L+kampung.bayi_lahir_P) as total_sasaran_bayi_lahir,

          ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL1,
          ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL1,
          ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP1,
          ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP1,
          ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total1,
          ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total1,


          ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL2,
          ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL2,
          ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP2,
          ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP2,
          ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total2,
          ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total2,


          ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL3,
          ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL3,
          ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP3,
          ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP3,
          ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total3,
          ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total3,

          kampung.surviving_infant_L as sasaran_si_L,
          kampung.surviving_infant_P as sasaran_si_P,
          (kampung.surviving_infant_L+kampung.surviving_infant_P) as total_sasaran_si,

          ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL4,
          ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL4,
          ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP4,
          ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP4,
          ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total4,
          ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total4,


          ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL5,
          ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL5,
          ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP5,
          ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP5,
          ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total5,
          ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total5,



          ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL6,
          ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL6,
          ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP6,
          ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP6,
          ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total6,
          ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total6,



          ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL7,
          ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL7,
          ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP7,
          ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP7,
          ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total7,
          ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total7,



          ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL8,
          ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL8,
          ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP8,
          ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP8,
          ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total8,
          ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total8,



          ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL9,
          ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL9,
          ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP9,
          ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP9,
          ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total9,
          ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total9,



          ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL10,
          ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL10,
          ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP10,
          ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP10,
          ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total10,
          ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total10,



          ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL11,
          ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL11,
          ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP11,
          ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP11,
          ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total11,
          ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total11,

          kampung.baduta_L as sasaran_baduta_L,
          kampung.baduta_P as sasaran_baduta_P,
          (kampung.baduta_L+kampung.baduta_P) as total_sasaran_baduta,

          ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL12,
          ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL12,
          ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP12,
          ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP12,
          ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total12,
          ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total12,


          ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL13,
          ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL13,
          ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP13,
          ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP13,
          ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total13,
          ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total13,

          kampung.sd_1_L as sasaran_sd_1_L,
          kampung.sd_1_P as sasaran_sd_1_P,
          (kampung.sd_1_L+kampung.sd_1_P) as total_sasaran_sd_1,

          ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL14,
          ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL14,
          ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP14,
          ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP14,
          ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total14,
          ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total14,


          ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL15,
          ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL15,
          ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP15,
          ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP15,
          ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total15,
          ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total15,

          kampung.sd_2_L as sasaran_sd_2_L,
          kampung.sd_2_P as sasaran_sd_2_P,
          (kampung.sd_2_L+kampung.sd_2_P) as total_sasaran_sd_2,

          ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL16,
          ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_2_L*100, 2) as persen_jumlahL16,
          ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP16,
          ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_2_P*100, 2) as persen_jumlahP16,
          ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total16,
          ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_2_L + kampung.sd_2_P)*100, 2) as persen_total16,

          kampung.sd_5_L as sasaran_sd_5_L,
          kampung.sd_5_P as sasaran_sd_5_P,
          (kampung.sd_5_L+kampung.sd_5_P) as total_sasaran_sd_5,

          ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL17,
          ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL17,
          ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP17,
          ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP17,
          ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total17,
          ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total17,


          ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL18,
          ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL18,
          ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP18,
          ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP18,
          ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total18,
          ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total18,

          kampung.sd_6_L as sasaran_sd_6_L,
          kampung.sd_6_P as sasaran_sd_6_P,
          (kampung.sd_6_L+kampung.sd_6_P) as total_sasaran_sd_6,

          ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL19,
          ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_6_L*100, 2) as persen_jumlahL19,
          ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP19,
          ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_6_P*100, 2) as persen_jumlahP19,
          ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total19,
          ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_6_L + kampung.sd_6_P)*100, 2) as persen_total19


          FROM kampung
              LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
              LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
              LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
              LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
              LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
          WHERE kabupaten.id_kabupaten = $kabupatenForm
              AND puskesmas.id_puskesmas = $puskesmasForm
          GROUP BY kampung.id_kampung
          ORDER BY kampung.id_kampung

        ");
        $query1 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,

        kampung.bayi_lahir_L as sasaran_bayi_lahir_L,
        kampung.bayi_lahir_P as sasaran_bayi_lahir_P,
        (kampung.bayi_lahir_L+kampung.bayi_lahir_P) as total_sasaran_bayi_lahir,

        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total1,


        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total2,


        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total3,

        kampung.surviving_infant_L as sasaran_si_L,
        kampung.surviving_infant_P as sasaran_si_P,
        (kampung.surviving_infant_L+kampung.surviving_infant_P) as total_sasaran_si,

        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total4,


        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total5,



        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total6,



        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total7,



        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total8,



        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total9,



        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total10,



        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total11,

        kampung.baduta_L as sasaran_baduta_L,
        kampung.baduta_P as sasaran_baduta_P,
        (kampung.baduta_L+kampung.baduta_P) as total_sasaran_baduta,

        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total12,


        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total13,

        kampung.sd_1_L as sasaran_sd_1_L,
        kampung.sd_1_P as sasaran_sd_1_P,
        (kampung.sd_1_L+kampung.sd_1_P) as total_sasaran_sd_1,

        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total14,


        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total15,

        kampung.sd_2_L as sasaran_sd_2_L,
        kampung.sd_2_P as sasaran_sd_2_P,
        (kampung.sd_2_L+kampung.sd_2_P) as total_sasaran_sd_2,

        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_2_L*100, 2) as persen_jumlahL16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_2_P*100, 2) as persen_jumlahP16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_2_L + kampung.sd_2_P)*100, 2) as persen_total16,

        kampung.sd_5_L as sasaran_sd_5_L,
        kampung.sd_5_P as sasaran_sd_5_P,
        (kampung.sd_5_L+kampung.sd_5_P) as total_sasaran_sd_5,

        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total17,


        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total18,

        kampung.sd_6_L as sasaran_sd_6_L,
        kampung.sd_6_P as sasaran_sd_6_P,
        (kampung.sd_6_L+kampung.sd_6_P) as total_sasaran_sd_6,

        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_6_L*100, 2) as persen_jumlahL19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_6_P*100, 2) as persen_jumlahP19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_6_L + kampung.sd_6_P)*100, 2) as persen_total19


        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = $kabupatenForm
            AND puskesmas.id_puskesmas = $puskesmasForm
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");
        $query2 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,

        kampung.bayi_lahir_L as sasaran_bayi_lahir_L,
        kampung.bayi_lahir_P as sasaran_bayi_lahir_P,
        (kampung.bayi_lahir_L+kampung.bayi_lahir_P) as total_sasaran_bayi_lahir,

        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total1,


        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total2,


        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total3,

        kampung.surviving_infant_L as sasaran_si_L,
        kampung.surviving_infant_P as sasaran_si_P,
        (kampung.surviving_infant_L+kampung.surviving_infant_P) as total_sasaran_si,

        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total4,


        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total5,



        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total6,



        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total7,



        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total8,



        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total9,



        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total10,



        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total11,

        kampung.baduta_L as sasaran_baduta_L,
        kampung.baduta_P as sasaran_baduta_P,
        (kampung.baduta_L+kampung.baduta_P) as total_sasaran_baduta,

        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total12,


        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total13,

        kampung.sd_1_L as sasaran_sd_1_L,
        kampung.sd_1_P as sasaran_sd_1_P,
        (kampung.sd_1_L+kampung.sd_1_P) as total_sasaran_sd_1,

        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total14,


        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total15,

        kampung.sd_2_L as sasaran_sd_2_L,
        kampung.sd_2_P as sasaran_sd_2_P,
        (kampung.sd_2_L+kampung.sd_2_P) as total_sasaran_sd_2,

        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_2_L*100, 2) as persen_jumlahL16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_2_P*100, 2) as persen_jumlahP16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_2_L + kampung.sd_2_P)*100, 2) as persen_total16,

        kampung.sd_5_L as sasaran_sd_5_L,
        kampung.sd_5_P as sasaran_sd_5_P,
        (kampung.sd_5_L+kampung.sd_5_P) as total_sasaran_sd_5,

        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total17,


        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total18,

        kampung.sd_6_L as sasaran_sd_6_L,
        kampung.sd_6_P as sasaran_sd_6_P,
        (kampung.sd_6_L+kampung.sd_6_P) as total_sasaran_sd_6,

        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_6_L*100, 2) as persen_jumlahL19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_6_P*100, 2) as persen_jumlahP19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_6_L + kampung.sd_6_P)*100, 2) as persen_total19


        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = $kabupatenForm
            AND puskesmas.id_puskesmas = $puskesmasForm
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung
        ");
        $query3 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,

        kampung.bayi_lahir_L as sasaran_bayi_lahir_L,
        kampung.bayi_lahir_P as sasaran_bayi_lahir_P,
        (kampung.bayi_lahir_L+kampung.bayi_lahir_P) as total_sasaran_bayi_lahir,

        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total1,


        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total2,


        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total3,

        kampung.surviving_infant_L as sasaran_si_L,
        kampung.surviving_infant_P as sasaran_si_P,
        (kampung.surviving_infant_L+kampung.surviving_infant_P) as total_sasaran_si,

        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total4,


        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total5,



        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total6,



        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total7,



        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total8,



        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total9,



        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total10,



        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total11,

        kampung.baduta_L as sasaran_baduta_L,
        kampung.baduta_P as sasaran_baduta_P,
        (kampung.baduta_L+kampung.baduta_P) as total_sasaran_baduta,

        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total12,


        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total13,

        kampung.sd_1_L as sasaran_sd_1_L,
        kampung.sd_1_P as sasaran_sd_1_P,
        (kampung.sd_1_L+kampung.sd_1_P) as total_sasaran_sd_1,

        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total14,


        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total15,

        kampung.sd_2_L as sasaran_sd_2_L,
        kampung.sd_2_P as sasaran_sd_2_P,
        (kampung.sd_2_L+kampung.sd_2_P) as total_sasaran_sd_2,

        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_2_L*100, 2) as persen_jumlahL16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_2_P*100, 2) as persen_jumlahP16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_2_L + kampung.sd_2_P)*100, 2) as persen_total16,

        kampung.sd_5_L as sasaran_sd_5_L,
        kampung.sd_5_P as sasaran_sd_5_P,
        (kampung.sd_5_L+kampung.sd_5_P) as total_sasaran_sd_5,

        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total17,


        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total18,

        kampung.sd_6_L as sasaran_sd_6_L,
        kampung.sd_6_P as sasaran_sd_6_P,
        (kampung.sd_6_L+kampung.sd_6_P) as total_sasaran_sd_6,

        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_6_L*100, 2) as persen_jumlahL19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_6_P*100, 2) as persen_jumlahP19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_6_L + kampung.sd_6_P)*100, 2) as persen_total19


    FROM kampung
        LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
        LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
        LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
        LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
        LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
    WHERE kabupaten.id_kabupaten = $kabupatenForm
        AND puskesmas.id_puskesmas = $puskesmasForm
    GROUP BY kampung.id_kampung
    ORDER BY kampung.id_kampung
        ");
        $query4 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,

        kampung.bayi_lahir_L as sasaran_bayi_lahir_L,
        kampung.bayi_lahir_P as sasaran_bayi_lahir_P,
        (kampung.bayi_lahir_L+kampung.bayi_lahir_P) as total_sasaran_bayi_lahir,

        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total1,


        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total2,


        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total3,

        kampung.surviving_infant_L as sasaran_si_L,
        kampung.surviving_infant_P as sasaran_si_P,
        (kampung.surviving_infant_L+kampung.surviving_infant_P) as total_sasaran_si,

        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total4,


        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total5,



        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total6,



        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total7,



        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total8,



        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total9,



        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total10,



        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total11,

        kampung.baduta_L as sasaran_baduta_L,
        kampung.baduta_P as sasaran_baduta_P,
        (kampung.baduta_L+kampung.baduta_P) as total_sasaran_baduta,

        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total12,


        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total13,

        kampung.sd_1_L as sasaran_sd_1_L,
        kampung.sd_1_P as sasaran_sd_1_P,
        (kampung.sd_1_L+kampung.sd_1_P) as total_sasaran_sd_1,

        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total14,


        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total15,

        kampung.sd_2_L as sasaran_sd_2_L,
        kampung.sd_2_P as sasaran_sd_2_P,
        (kampung.sd_2_L+kampung.sd_2_P) as total_sasaran_sd_2,

        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_2_L*100, 2) as persen_jumlahL16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_2_P*100, 2) as persen_jumlahP16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_2_L + kampung.sd_2_P)*100, 2) as persen_total16,

        kampung.sd_5_L as sasaran_sd_5_L,
        kampung.sd_5_P as sasaran_sd_5_P,
        (kampung.sd_5_L+kampung.sd_5_P) as total_sasaran_sd_5,

        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total17,


        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total18,

        kampung.sd_6_L as sasaran_sd_6_L,
        kampung.sd_6_P as sasaran_sd_6_P,
        (kampung.sd_6_L+kampung.sd_6_P) as total_sasaran_sd_6,

        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_6_L*100, 2) as persen_jumlahL19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_6_P*100, 2) as persen_jumlahP19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_6_L + kampung.sd_6_P)*100, 2) as persen_total19


        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = $kabupatenForm
            AND puskesmas.id_puskesmas = $puskesmasForm
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung
        ");

        $query5 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,

        kampung.bayi_lahir_L as sasaran_bayi_lahir_L,
        kampung.bayi_lahir_P as sasaran_bayi_lahir_P,
        (kampung.bayi_lahir_L+kampung.bayi_lahir_P) as total_sasaran_bayi_lahir,

        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total1,


        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total2,


        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total3,

        kampung.surviving_infant_L as sasaran_si_L,
        kampung.surviving_infant_P as sasaran_si_P,
        (kampung.surviving_infant_L+kampung.surviving_infant_P) as total_sasaran_si,

        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total4,


        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total5,



        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total6,



        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total7,



        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total8,



        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total9,



        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total10,



        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total11,

        kampung.baduta_L as sasaran_baduta_L,
        kampung.baduta_P as sasaran_baduta_P,
        (kampung.baduta_L+kampung.baduta_P) as total_sasaran_baduta,

        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total12,


        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total13,

        kampung.sd_1_L as sasaran_sd_1_L,
        kampung.sd_1_P as sasaran_sd_1_P,
        (kampung.sd_1_L+kampung.sd_1_P) as total_sasaran_sd_1,

        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total14,


        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total15,

        kampung.sd_2_L as sasaran_sd_2_L,
        kampung.sd_2_P as sasaran_sd_2_P,
        (kampung.sd_2_L+kampung.sd_2_P) as total_sasaran_sd_2,

        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_2_L*100, 2) as persen_jumlahL16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_2_P*100, 2) as persen_jumlahP16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_2_L + kampung.sd_2_P)*100, 2) as persen_total16,

        kampung.sd_5_L as sasaran_sd_5_L,
        kampung.sd_5_P as sasaran_sd_5_P,
        (kampung.sd_5_L+kampung.sd_5_P) as total_sasaran_sd_5,

        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total17,


        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total18,

        kampung.sd_6_L as sasaran_sd_6_L,
        kampung.sd_6_P as sasaran_sd_6_P,
        (kampung.sd_6_L+kampung.sd_6_P) as total_sasaran_sd_6,

        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_6_L*100, 2) as persen_jumlahL19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_6_P*100, 2) as persen_jumlahP19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_6_L + kampung.sd_6_P)*100, 2) as persen_total19


        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = $kabupatenForm
            AND puskesmas.id_puskesmas = $puskesmasForm
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung
        ");
        $query6 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,

        kampung.bayi_lahir_L as sasaran_bayi_lahir_L,
        kampung.bayi_lahir_P as sasaran_bayi_lahir_P,
        (kampung.bayi_lahir_L+kampung.bayi_lahir_P) as total_sasaran_bayi_lahir,

        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total1,


        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total2,


        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total3,

        kampung.surviving_infant_L as sasaran_si_L,
        kampung.surviving_infant_P as sasaran_si_P,
        (kampung.surviving_infant_L+kampung.surviving_infant_P) as total_sasaran_si,

        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total4,


        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total5,



        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total6,



        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total7,



        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total8,



        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total9,



        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total10,



        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total11,

        kampung.baduta_L as sasaran_baduta_L,
        kampung.baduta_P as sasaran_baduta_P,
        (kampung.baduta_L+kampung.baduta_P) as total_sasaran_baduta,

        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total12,


        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total13,

        kampung.sd_1_L as sasaran_sd_1_L,
        kampung.sd_1_P as sasaran_sd_1_P,
        (kampung.sd_1_L+kampung.sd_1_P) as total_sasaran_sd_1,

        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total14,


        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total15,

        kampung.sd_2_L as sasaran_sd_2_L,
        kampung.sd_2_P as sasaran_sd_2_P,
        (kampung.sd_2_L+kampung.sd_2_P) as total_sasaran_sd_2,

        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_2_L*100, 2) as persen_jumlahL16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_2_P*100, 2) as persen_jumlahP16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_2_L + kampung.sd_2_P)*100, 2) as persen_total16,

        kampung.sd_5_L as sasaran_sd_5_L,
        kampung.sd_5_P as sasaran_sd_5_P,
        (kampung.sd_5_L+kampung.sd_5_P) as total_sasaran_sd_5,

        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total17,


        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total18,

        kampung.sd_6_L as sasaran_sd_6_L,
        kampung.sd_6_P as sasaran_sd_6_P,
        (kampung.sd_6_L+kampung.sd_6_P) as total_sasaran_sd_6,

        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_6_L*100, 2) as persen_jumlahL19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_6_P*100, 2) as persen_jumlahP19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_6_L + kampung.sd_6_P)*100, 2) as persen_total19


        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = $kabupatenForm
            AND puskesmas.id_puskesmas = $puskesmasForm
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung
        ");
        $query7 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,

        kampung.bayi_lahir_L as sasaran_bayi_lahir_L,
        kampung.bayi_lahir_P as sasaran_bayi_lahir_P,
        (kampung.bayi_lahir_L+kampung.bayi_lahir_P) as total_sasaran_bayi_lahir,

        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total1,


        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total2,


        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total3,

        kampung.surviving_infant_L as sasaran_si_L,
        kampung.surviving_infant_P as sasaran_si_P,
        (kampung.surviving_infant_L+kampung.surviving_infant_P) as total_sasaran_si,

        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total4,


        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total5,



        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total6,



        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total7,



        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total8,



        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total9,



        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total10,



        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total11,

        kampung.baduta_L as sasaran_baduta_L,
        kampung.baduta_P as sasaran_baduta_P,
        (kampung.baduta_L+kampung.baduta_P) as total_sasaran_baduta,

        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total12,


        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total13,

        kampung.sd_1_L as sasaran_sd_1_L,
        kampung.sd_1_P as sasaran_sd_1_P,
        (kampung.sd_1_L+kampung.sd_1_P) as total_sasaran_sd_1,

        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total14,


        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total15,

        kampung.sd_2_L as sasaran_sd_2_L,
        kampung.sd_2_P as sasaran_sd_2_P,
        (kampung.sd_2_L+kampung.sd_2_P) as total_sasaran_sd_2,

        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_2_L*100, 2) as persen_jumlahL16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_2_P*100, 2) as persen_jumlahP16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_2_L + kampung.sd_2_P)*100, 2) as persen_total16,

        kampung.sd_5_L as sasaran_sd_5_L,
        kampung.sd_5_P as sasaran_sd_5_P,
        (kampung.sd_5_L+kampung.sd_5_P) as total_sasaran_sd_5,

        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total17,


        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total18,

        kampung.sd_6_L as sasaran_sd_6_L,
        kampung.sd_6_P as sasaran_sd_6_P,
        (kampung.sd_6_L+kampung.sd_6_P) as total_sasaran_sd_6,

        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_6_L*100, 2) as persen_jumlahL19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_6_P*100, 2) as persen_jumlahP19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_6_L + kampung.sd_6_P)*100, 2) as persen_total19


        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = $kabupatenForm
            AND puskesmas.id_puskesmas = $puskesmasForm
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung
        ");
        $query8 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,

        kampung.bayi_lahir_L as sasaran_bayi_lahir_L,
        kampung.bayi_lahir_P as sasaran_bayi_lahir_P,
        (kampung.bayi_lahir_L+kampung.bayi_lahir_P) as total_sasaran_bayi_lahir,

        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total1,


        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total2,


        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total3,

        kampung.surviving_infant_L as sasaran_si_L,
        kampung.surviving_infant_P as sasaran_si_P,
        (kampung.surviving_infant_L+kampung.surviving_infant_P) as total_sasaran_si,

        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total4,


        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total5,



        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total6,



        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total7,



        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total8,



        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total9,



        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total10,



        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total11,

        kampung.baduta_L as sasaran_baduta_L,
        kampung.baduta_P as sasaran_baduta_P,
        (kampung.baduta_L+kampung.baduta_P) as total_sasaran_baduta,

        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total12,


        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total13,

        kampung.sd_1_L as sasaran_sd_1_L,
        kampung.sd_1_P as sasaran_sd_1_P,
        (kampung.sd_1_L+kampung.sd_1_P) as total_sasaran_sd_1,

        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total14,


        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total15,

        kampung.sd_2_L as sasaran_sd_2_L,
        kampung.sd_2_P as sasaran_sd_2_P,
        (kampung.sd_2_L+kampung.sd_2_P) as total_sasaran_sd_2,

        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_2_L*100, 2) as persen_jumlahL16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_2_P*100, 2) as persen_jumlahP16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_2_L + kampung.sd_2_P)*100, 2) as persen_total16,

        kampung.sd_5_L as sasaran_sd_5_L,
        kampung.sd_5_P as sasaran_sd_5_P,
        (kampung.sd_5_L+kampung.sd_5_P) as total_sasaran_sd_5,

        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total17,


        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total18,

        kampung.sd_6_L as sasaran_sd_6_L,
        kampung.sd_6_P as sasaran_sd_6_P,
        (kampung.sd_6_L+kampung.sd_6_P) as total_sasaran_sd_6,

        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_6_L*100, 2) as persen_jumlahL19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_6_P*100, 2) as persen_jumlahP19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_6_L + kampung.sd_6_P)*100, 2) as persen_total19


        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = $kabupatenForm
            AND puskesmas.id_puskesmas = $puskesmasForm
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung


        ");
        $query9 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,

        kampung.bayi_lahir_L as sasaran_bayi_lahir_L,
        kampung.bayi_lahir_P as sasaran_bayi_lahir_P,
        (kampung.bayi_lahir_L+kampung.bayi_lahir_P) as total_sasaran_bayi_lahir,

        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total1,


        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total2,


        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total3,

        kampung.surviving_infant_L as sasaran_si_L,
        kampung.surviving_infant_P as sasaran_si_P,
        (kampung.surviving_infant_L+kampung.surviving_infant_P) as total_sasaran_si,

        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total4,


        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total5,



        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total6,



        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total7,



        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total8,



        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total9,



        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total10,



        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total11,

        kampung.baduta_L as sasaran_baduta_L,
        kampung.baduta_P as sasaran_baduta_P,
        (kampung.baduta_L+kampung.baduta_P) as total_sasaran_baduta,

        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total12,


        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total13,

        kampung.sd_1_L as sasaran_sd_1_L,
        kampung.sd_1_P as sasaran_sd_1_P,
        (kampung.sd_1_L+kampung.sd_1_P) as total_sasaran_sd_1,

        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total14,


        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total15,

        kampung.sd_2_L as sasaran_sd_2_L,
        kampung.sd_2_P as sasaran_sd_2_P,
        (kampung.sd_2_L+kampung.sd_2_P) as total_sasaran_sd_2,

        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_2_L*100, 2) as persen_jumlahL16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_2_P*100, 2) as persen_jumlahP16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_2_L + kampung.sd_2_P)*100, 2) as persen_total16,

        kampung.sd_5_L as sasaran_sd_5_L,
        kampung.sd_5_P as sasaran_sd_5_P,
        (kampung.sd_5_L+kampung.sd_5_P) as total_sasaran_sd_5,

        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total17,


        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total18,

        kampung.sd_6_L as sasaran_sd_6_L,
        kampung.sd_6_P as sasaran_sd_6_P,
        (kampung.sd_6_L+kampung.sd_6_P) as total_sasaran_sd_6,

        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_6_L*100, 2) as persen_jumlahL19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_6_P*100, 2) as persen_jumlahP19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_6_L + kampung.sd_6_P)*100, 2) as persen_total19


        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = $kabupatenForm
            AND puskesmas.id_puskesmas = $puskesmasForm
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung

        ");
        $query10 = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
        puskesmas.nama_puskesmas as puskesmas,
        kampung.nama_kampung as kampung,

        kampung.bayi_lahir_L as sasaran_bayi_lahir_L,
        kampung.bayi_lahir_P as sasaran_bayi_lahir_P,
        (kampung.bayi_lahir_L+kampung.bayi_lahir_P) as total_sasaran_bayi_lahir,

        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total1,
        ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total1,


        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total2,
        ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total2,


        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total3,
        ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total3,

        kampung.surviving_infant_L as sasaran_si_L,
        kampung.surviving_infant_P as sasaran_si_P,
        (kampung.surviving_infant_L+kampung.surviving_infant_P) as total_sasaran_si,

        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total4,
        ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total4,


        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total5,
        ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total5,



        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total6,
        ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total6,



        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total7,
        ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total7,



        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total8,
        ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total8,



        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total9,
        ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total9,



        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total10,
        ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total10,



        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total11,
        ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total11,

        kampung.baduta_L as sasaran_baduta_L,
        kampung.baduta_P as sasaran_baduta_P,
        (kampung.baduta_L+kampung.baduta_P) as total_sasaran_baduta,

        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total12,
        ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total12,


        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total13,
        ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total13,

        kampung.sd_1_L as sasaran_sd_1_L,
        kampung.sd_1_P as sasaran_sd_1_P,
        (kampung.sd_1_L+kampung.sd_1_P) as total_sasaran_sd_1,

        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total14,
        ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total14,


        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total15,
        ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total15,

        kampung.sd_2_L as sasaran_sd_2_L,
        kampung.sd_2_P as sasaran_sd_2_P,
        (kampung.sd_2_L+kampung.sd_2_P) as total_sasaran_sd_2,

        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_2_L*100, 2) as persen_jumlahL16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_2_P*100, 2) as persen_jumlahP16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total16,
        ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_2_L + kampung.sd_2_P)*100, 2) as persen_total16,

        kampung.sd_5_L as sasaran_sd_5_L,
        kampung.sd_5_P as sasaran_sd_5_P,
        (kampung.sd_5_L+kampung.sd_5_P) as total_sasaran_sd_5,

        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total17,
        ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total17,


        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total18,
        ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total18,

        kampung.sd_6_L as sasaran_sd_6_L,
        kampung.sd_6_P as sasaran_sd_6_P,
        (kampung.sd_6_L+kampung.sd_6_P) as total_sasaran_sd_6,

        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_6_L*100, 2) as persen_jumlahL19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_6_P*100, 2) as persen_jumlahP19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total19,
        ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_6_L + kampung.sd_6_P)*100, 2) as persen_total19


        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten = $kabupatenForm
            AND puskesmas.id_puskesmas = $puskesmasForm
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung


        ");
        $query11 = DB::select("
          SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,

          kampung.bayi_lahir_L as sasaran_bayi_lahir_L,
          kampung.bayi_lahir_P as sasaran_bayi_lahir_P,
          (kampung.bayi_lahir_L+kampung.bayi_lahir_P) as total_sasaran_bayi_lahir,

          ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL1,
          ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL1,
          ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP1,
          ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP1,
          ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total1,
          ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total1,


          ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL2,
          ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL2,
          ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP2,
          ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP2,
          ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total2,
          ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total2,


          ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL3,
          ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL3,
          ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP3,
          ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP3,
          ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total3,
          ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total3,

          kampung.surviving_infant_L as sasaran_si_L,
          kampung.surviving_infant_P as sasaran_si_P,
          (kampung.surviving_infant_L+kampung.surviving_infant_P) as total_sasaran_si,

          ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL4,
          ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL4,
          ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP4,
          ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP4,
          ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total4,
          ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total4,


          ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL5,
          ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL5,
          ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP5,
          ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP5,
          ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total5,
          ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total5,



          ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL6,
          ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL6,
          ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP6,
          ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP6,
          ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total6,
          ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total6,



          ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL7,
          ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL7,
          ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP7,
          ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP7,
          ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total7,
          ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total7,



          ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL8,
          ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL8,
          ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP8,
          ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP8,
          ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total8,
          ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total8,



          ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL9,
          ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL9,
          ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP9,
          ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP9,
          ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total9,
          ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total9,



          ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL10,
          ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL10,
          ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP10,
          ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP10,
          ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total10,
          ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total10,



          ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL11,
          ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL11,
          ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP11,
          ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP11,
          ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total11,
          ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total11,

          kampung.baduta_L as sasaran_baduta_L,
          kampung.baduta_P as sasaran_baduta_P,
          (kampung.baduta_L+kampung.baduta_P) as total_sasaran_baduta,

          ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL12,
          ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL12,
          ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP12,
          ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP12,
          ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total12,
          ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total12,


          ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL13,
          ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL13,
          ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP13,
          ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP13,
          ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total13,
          ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total13,

          kampung.sd_1_L as sasaran_sd_1_L,
          kampung.sd_1_P as sasaran_sd_1_P,
          (kampung.sd_1_L+kampung.sd_1_P) as total_sasaran_sd_1,

          ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL14,
          ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL14,
          ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP14,
          ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP14,
          ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total14,
          ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total14,


          ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL15,
          ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL15,
          ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP15,
          ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP15,
          ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total15,
          ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total15,

          kampung.sd_2_L as sasaran_sd_2_L,
          kampung.sd_2_P as sasaran_sd_2_P,
          (kampung.sd_2_L+kampung.sd_2_P) as total_sasaran_sd_2,

          ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL16,
          ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_2_L*100, 2) as persen_jumlahL16,
          ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP16,
          ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_2_P*100, 2) as persen_jumlahP16,
          ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total16,
          ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_2_L + kampung.sd_2_P)*100, 2) as persen_total16,

          kampung.sd_5_L as sasaran_sd_5_L,
          kampung.sd_5_P as sasaran_sd_5_P,
          (kampung.sd_5_L+kampung.sd_5_P) as total_sasaran_sd_5,

          ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL17,
          ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL17,
          ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP17,
          ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP17,
          ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total17,
          ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total17,


          ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL18,
          ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL18,
          ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP18,
          ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP18,
          ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total18,
          ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total18,

          kampung.sd_6_L as sasaran_sd_6_L,
          kampung.sd_6_P as sasaran_sd_6_P,
          (kampung.sd_6_L+kampung.sd_6_P) as total_sasaran_sd_6,

          ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL19,
          ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_6_L*100, 2) as persen_jumlahL19,
          ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP19,
          ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_6_P*100, 2) as persen_jumlahP19,
          ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END), 0) as total19,
          ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_6_L + kampung.sd_6_P)*100, 2) as persen_total19


          FROM kampung
              LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
              LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
              LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
              LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
              LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
          WHERE kabupaten.id_kabupaten = $kabupatenForm
              AND puskesmas.id_puskesmas = $puskesmasForm
          GROUP BY kampung.id_kampung
          ORDER BY kampung.id_kampung
        ");



        return view('provinsi.capaian.laporanBulanan', ["query" => $query, "query1" => $query1, "query2" => $query2, "query3" => $query3, "query4" => $query4, "query5" => $query5, "query6" => $query6, "query7" => $query7, "query8" => $query8, "query9" => $query9, "query10" => $query10, "query11" => $query11, "tahunForm" => $tahunForm, "kabupatenForm" => $kabupatenForm, 'puskesmasForm'=>$puskesmasForm]);
    }

//    kerjaan naufal di atas

    public function kabupaten() {
        return view('provinsi.capaian.kabupaten.dashboard');
    }

    public function kampung() {
        return view('provinsi.capaian.kampung.dashboard');
    }

    public function puskesmas() {
        return view('provinsi.capaian.puskesmas.dashboard');
    }

    public function capaianAntigenKabupaten(Request $request) {
        $tahunForm = $request->tahunForm ?: 2020;
        $antigenForm = $request->antigenForm ?: 1;
        $antigens = (new AntigenModel)->getListAntigen();

        if ($antigenForm==1 || $antigenForm==2 || $antigenForm==3) {
            $query = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
          ROUND((ROUND(AVG(kabupaten.bayi_lahir_L+ kabupaten.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");



            $query1 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.bayi_lahir_L+ kabupaten.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
            WHERE kabupaten.id_kabupaten != 0
            GROUP BY kabupaten.id_kabupaten
            ORDER BY kabupaten.id_kabupaten
        ");





            $query2 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.bayi_lahir_L+ kabupaten.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query3 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.bayi_lahir_L+ kabupaten.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query4 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.bayi_lahir_L+ kabupaten.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query5 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.bayi_lahir_L+ kabupaten.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query6 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.bayi_lahir_L+ kabupaten.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query7 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.bayi_lahir_L+ kabupaten.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query8 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.bayi_lahir_L+ kabupaten.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query9 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.bayi_lahir_L+ kabupaten.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query10 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.bayi_lahir_L+ kabupaten.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query11 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.bayi_lahir_L+ kabupaten.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query12 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.bayi_lahir_L+ kabupaten.bayi_lahir_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");






        }
        elseif ($antigenForm==12 || $antigenForm==13) {
            $query = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
          ROUND((ROUND(AVG(kabupaten.baduta_L + kabupaten.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");



            $query1 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.baduta_L + kabupaten.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");





            $query2 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.baduta_L + kabupaten.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query3 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.baduta_L + kabupaten.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query4 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.baduta_L + kabupaten.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query5 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.baduta_L + kabupaten.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query6 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.baduta_L + kabupaten.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query7 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.baduta_L + kabupaten.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query8 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.baduta_L + kabupaten.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query9 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.baduta_L + kabupaten.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query10 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.baduta_L + kabupaten.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query11 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.baduta_L + kabupaten.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query12 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.baduta_L + kabupaten.baduta_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




        }
        elseif ($antigenForm==14 || $antigenForm==15) {
            $query = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
          ROUND((ROUND(AVG(kabupaten.sd_1_L + kabupaten.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");



            $query1 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_1_L + kabupaten.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");





            $query2 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_1_L + kabupaten.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query3 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_1_L + kabupaten.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query4 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_1_L + kabupaten.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query5 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_1_L + kabupaten.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query6 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_1_L + kabupaten.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query7 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_1_L + kabupaten.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query8 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_1_L + kabupaten.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query9 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_1_L + kabupaten.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query10 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_1_L + kabupaten.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query11 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_1_L + kabupaten.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query12 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_1_L + kabupaten.sd_1_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




        }
        elseif ($antigenForm==16) {
            $query = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
          ROUND((ROUND(AVG(kabupaten.sd_2_L + kabupaten.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");



            $query1 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_2_L + kabupaten.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");





            $query2 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_2_L + kabupaten.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query3 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_2_L + kabupaten.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query4 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_2_L + kabupaten.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query5 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_2_L + kabupaten.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query6 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_2_L + kabupaten.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query7 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_2_L + kabupaten.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query8 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_2_L + kabupaten.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query9 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_2_L + kabupaten.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query10 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_2_L + kabupaten.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query11 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_2_L + kabupaten.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query12 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_2_L + kabupaten.sd_2_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




        }
        elseif ($antigenForm==17 || $antigenForm==18) {
            $query = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
          ROUND((ROUND(AVG(kabupaten.sd_5_L + kabupaten.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");



            $query1 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_5_L + kabupaten.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");





            $query2 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_5_L + kabupaten.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query3 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_5_L + kabupaten.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query4 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_5_L + kabupaten.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query5 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_5_L + kabupaten.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query6 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_5_L + kabupaten.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query7 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_5_L + kabupaten.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query8 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_5_L + kabupaten.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query9 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_5_L + kabupaten.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query10 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_5_L + kabupaten.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query11 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_5_L + kabupaten.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query12 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_5_L + kabupaten.sd_5_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




        }
        elseif ($antigenForm==19) {
            $query = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
          ROUND((ROUND(AVG(kabupaten.sd_6_L + kabupaten.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");



            $query1 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_6_L + kabupaten.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");





            $query2 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_6_L + kabupaten.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query3 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_6_L + kabupaten.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query4 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_6_L + kabupaten.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query5 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_6_L + kabupaten.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query6 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_6_L + kabupaten.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query7 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_6_L + kabupaten.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query8 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_6_L + kabupaten.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query9 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_6_L + kabupaten.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query10 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_6_L + kabupaten.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query11 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_6_L + kabupaten.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query12 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.sd_6_L + kabupaten.sd_6_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




        }
        else {
            $query = DB::select("
        SELECT kabupaten.nama_kabupaten as kabupaten,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
          ROUND((ROUND(AVG(kabupaten.surviving_infant_L + kabupaten.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
          LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");



            $query1 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.surviving_infant_L + kabupaten.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");





            $query2 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.surviving_infant_L + kabupaten.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query3 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.surviving_infant_L + kabupaten.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query4 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.surviving_infant_L + kabupaten.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query5 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.surviving_infant_L + kabupaten.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query6 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.surviving_infant_L + kabupaten.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query7 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.surviving_infant_L + kabupaten.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query8 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.surviving_infant_L + kabupaten.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query9 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.surviving_infant_L + kabupaten.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query10 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.surviving_infant_L + kabupaten.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query11 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.surviving_infant_L + kabupaten.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");




            $query12 = DB::select("
            SELECT kabupaten.nama_kabupaten as kabupaten,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
            ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
            ROUND((ROUND(AVG(kabupaten.surviving_infant_L + kabupaten.surviving_infant_P),0))*(SELECT (antigen.target_tahunan/100) FROM antigen WHERE antigen.id_antigen={$antigenForm})) as target
        FROM kampung
            LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
            LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
            LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
            LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
            LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
                WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
        ");


        }

        return view('provinsi.capaian.capaianAntigenKabupaten', ["query" => $query, "query1" => $query1, "query2" => $query2, "query3" => $query3, "query4" => $query4, "query5" => $query5, "query6" => $query6, "query7" => $query7, "query8" => $query8, "query9" => $query9, "query10" => $query10, "query11" => $query11, "query12" => $query12, "tahunForm" => $tahunForm, "antigenForm" => $antigenForm, 'antigens'=>$antigens]);
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
    ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
    ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
    ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
    ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
    ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
    ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
    ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
    ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
    ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
    ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
    ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
    ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
    ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
    ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
    ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
    ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
    ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
    ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
    ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
    ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
    ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
        ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
      ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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

        return view('provinsi.capaian.capaianAntigenKampung', ['query' => $query, 'query1' => $query1, 'query2' => $query2, 'query3' => $query3, 'query4' => $query4, 'query5' => $query5, 'query6' => $query6, 'query7' => $query7, 'query8' => $query8, 'query9' => $query9, 'query10' => $query10, 'query11' => $query11, 'query12' => $query12, 'kabupatens' => $kabupatens, 'puskesmas' => $puskesmas, 'antigens' => $antigens, 'kabupatenForm' => $kabupatenForm, 'puskesmasForm' => $puskesmasForm, 'antigenForm' => $antigenForm, 'tahunForm' => $tahunForm]);
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} THEN 1 ELSE 0 END), 0) as jumlah,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP,
          ROUND(SUM(CASE WHEN antigen.id_antigen={$antigenForm} AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = {$tahunForm} AND  data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL,
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


        return view('provinsi.capaian.capaianPuskesmas', ['kabupatens' => $kabupatens, 'antigens' => $antigens, 'kabupatenForm' => $kabupatenForm, 'antigenForm' => $antigenForm, 'tahunForm' => $tahunForm, 'query' => $query, 'query1' => $query1, 'query2' => $query2, 'query3' => $query3, 'query4' => $query4, 'query5' => $query5, 'query6' => $query6, 'query7' => $query7, 'query8' => $query8, 'query9' => $query9, 'query10' => $query10, 'query11' => $query11, 'query12' => $query12]);
    }


    public function capaianIDL(Request $request) {
        $tahunForm = $request->tahunForm ?: 2020;

        $query = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          ROUND(SUM(CASE WHEN data_individu.idl = 1 AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END), 0) as idl,
          (kabupaten.surviving_infant_L + kabupaten.surviving_infant_P) as sasaran
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
    ");


        $query1 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
        ROUND(SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END), 0) as idl,
        ROUND((kabupaten.surviving_infant_L + kabupaten.surviving_infant_P)*0.2) as sasaran
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
    ");


        $query2 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
        ROUND(SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03 OR MONTH(data_individu.tanggal_idl) = 04 OR MONTH(data_individu.tanggal_idl) = 05 OR MONTH(data_individu.tanggal_idl) = 06) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END), 0) as idl,
        ROUND((kabupaten.surviving_infant_L + kabupaten.surviving_infant_P)*0.4) as sasaran
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
    ");


        $query3 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
        ROUND(SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03 OR MONTH(data_individu.tanggal_idl) = 04 OR MONTH(data_individu.tanggal_idl) = 05 OR MONTH(data_individu.tanggal_idl) = 06 OR MONTH(data_individu.tanggal_idl) = 07 OR MONTH(data_individu.tanggal_idl) = 08 OR MONTH(data_individu.tanggal_idl) = 09) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END), 0) as idl,
        ROUND((kabupaten.surviving_infant_L + kabupaten.surviving_infant_P)*0.6) as sasaran
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
    ");


        $query4 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
        ROUND(SUM(CASE WHEN data_individu.idl = 1 AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END), 0) as idl,
        ROUND((kabupaten.surviving_infant_L + kabupaten.surviving_infant_P)*0.8) as sasaran
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
    ");

        return view('provinsi.capaian.capaianIDL', ['tahunForm' => $tahunForm, 'query' => $query, 'query1' => $query1, 'query2' => $query2, 'query3' => $query3, 'query4' => $query4,]);
    }

    public function capaianIRL(Request $request) {
        $tahunForm = $request->tahunForm ?: 2020;

        $query = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          ROUND(SUM(CASE WHEN data_individu.irl = 1 AND YEAR(data_individu.tanggal_irl) = {$tahunForm} THEN 1 ELSE 0 END), 0) as irl
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
    ");

        $query1 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          ROUND(SUM(CASE WHEN data_individu.irl = 1 AND (MONTH(data_individu.tanggal_irl) = 01 OR MONTH(data_individu.tanggal_irl) = 02 OR MONTH(data_individu.tanggal_irl) = 03) AND YEAR(data_individu.tanggal_irl) = {$tahunForm} THEN 1 ELSE 0 END), 0) as irl
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
    ");

        $query2 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          ROUND(SUM(CASE WHEN data_individu.irl = 1 AND (MONTH(data_individu.tanggal_irl) = 01 OR MONTH(data_individu.tanggal_irl) = 02 OR MONTH(data_individu.tanggal_irl) = 03 OR MONTH(data_individu.tanggal_irl) = 04 OR MONTH(data_individu.tanggal_irl) = 05 OR MONTH(data_individu.tanggal_irl) = 06) AND YEAR(data_individu.tanggal_irl) = {$tahunForm} THEN 1 ELSE 0 END), 0) as irl
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
    ");

        $query3 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          ROUND(SUM(CASE WHEN data_individu.irl = 1 AND (MONTH(data_individu.tanggal_irl) = 01 OR MONTH(data_individu.tanggal_irl) = 02 OR MONTH(data_individu.tanggal_irl) = 03 OR MONTH(data_individu.tanggal_irl) = 04 OR MONTH(data_individu.tanggal_irl) = 05 OR MONTH(data_individu.tanggal_irl) = 06 OR MONTH(data_individu.tanggal_irl) = 07 OR MONTH(data_individu.tanggal_irl) = 08 OR MONTH(data_individu.tanggal_irl) = 09) AND YEAR(data_individu.tanggal_irl) = {$tahunForm} THEN 1 ELSE 0 END), 0) as irl
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
    ");

        $query4 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
          ROUND(SUM(CASE WHEN data_individu.irl = 1 AND YEAR(data_individu.tanggal_irl) = {$tahunForm} THEN 1 ELSE 0 END), 0) as irl
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
    ");


        return view('provinsi.capaian.capaianIRL', ['tahunForm' => $tahunForm, 'query' => $query, 'query1' => $query1, 'query2' => $query2, 'query3' => $query3, 'query4' => $query4,]);
    }


    public function capaianT(Request $request)
    {
        $tahunForm = $request->tahunForm ?: 2020;

        $query = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil+kabupaten.wus_hamil)*100, 2)) as t1_total,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_hamil)*100, 2)) as t1_hamil,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil)*100, 2)) as t1_tidak_hamil,

        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil+kabupaten.wus_hamil)*100, 2)) as t2_total,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_hamil)*100, 2)) as t2_hamil,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil)*100, 2)) as t2_tidak_hamil,

        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil+kabupaten.wus_hamil)*100, 2)) as t3_total,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_hamil)*100, 2)) as t3_hamil,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil)*100, 2)) as t3_tidak_hamil,

        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil+kabupaten.wus_hamil)*100, 2)) as t4_total,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_hamil)*100, 2)) as t4_hamil,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil)*100, 2)) as t4_tidak_hamil,

        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil+kabupaten.wus_hamil)*100, 2)) as t5_total,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_hamil)*100, 2)) as t5_hamil,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil)*100, 2)) as t5_tidak_hamil

        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
          WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
    ");

        $query1 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil+kabupaten.wus_hamil)*100, 2)) as t1_total,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_hamil)*100, 2)) as t1_hamil,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil)*100, 2)) as t1_tidak_hamil,

        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil+kabupaten.wus_hamil)*100, 2)) as t2_total,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_hamil)*100, 2)) as t2_hamil,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil)*100, 2)) as t2_tidak_hamil,

        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil+kabupaten.wus_hamil)*100, 2)) as t3_total,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_hamil)*100, 2)) as t3_hamil,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil)*100, 2)) as t3_tidak_hamil,

        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil+kabupaten.wus_hamil)*100, 2)) as t4_total,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_hamil)*100, 2)) as t4_hamil,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil)*100, 2)) as t4_tidak_hamil,

        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil+kabupaten.wus_hamil)*100, 2)) as t5_total,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_hamil)*100, 2)) as t5_hamil,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil)*100, 2)) as t5_tidak_hamil

        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
    ");

        $query2 = DB::select("
    SELECT kabupaten.nama_kabupaten as kabupaten,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil+kabupaten.wus_hamil)*100, 2)) as t1_total,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_hamil)*100, 2)) as t1_hamil,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t1' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil)*100, 2)) as t1_tidak_hamil,

        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil+kabupaten.wus_hamil)*100, 2)) as t2_total,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_hamil)*100, 2)) as t2_hamil,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t2' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil)*100, 2)) as t2_tidak_hamil,

        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil+kabupaten.wus_hamil)*100, 2)) as t3_total,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_hamil)*100, 2)) as t3_hamil,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t3' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil)*100, 2)) as t3_tidak_hamil,

        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil+kabupaten.wus_hamil)*100, 2)) as t4_total,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_hamil)*100, 2)) as t4_hamil,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t4' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil)*100, 2)) as t4_tidak_hamil,

        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil+kabupaten.wus_hamil)*100, 2)) as t5_total,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.status_hamil='hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_hamil)*100, 2)) as t5_hamil,
        ROUND(ROUND(SUM(CASE WHEN data_individu.status_t='t5' AND data_individu.status_hamil='tidak hamil' AND data_individu.jenis_kelamin='p' AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END)/(kabupaten.wus_tidak_hamil)*100, 2)) as t5_tidak_hamil

        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        WHERE kabupaten.id_kabupaten != 0
        GROUP BY kabupaten.id_kabupaten
        ORDER BY kabupaten.id_kabupaten
    ");

        return view('provinsi.capaian.capaianT', ['tahunForm' => $tahunForm, 'query' => $query, 'query1' => $query1, 'query2' => $query2]);
    }

    public function capaianUCI(Request $request) {
        $tahunForm = $request->tahunForm ?: 2020;

        return view('provinsi.capaian.capaianUCI', ['tahunForm' => $tahunForm]);
    }

    public function getListUciByQuarterId($year, $quarter) {
        $tahunForm = $year;
        $query = "";

        if ($quarter == 1) {
            $query = "SELECT kabupaten.nama_kabupaten as kabupaten,
	puskesmas.nama_puskesmas as puskesmas,
    kampung.nama_kampung as kampung,
    ROUND(SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END), 0) as idl,
    ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)) as sasaran,
    ((ROUND(SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END))/(ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)))*100, 2)) as ketercapaian,
    (CASE WHEN ((ROUND(SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END))/(ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)))*100, 2)) >= 20 THEN 'UCI' ELSE 'Non-UCI' END), 0) as uci
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung";
        }
        elseif  ($quarter == 2) {
            $query = "SELECT kabupaten.nama_kabupaten as kabupaten,
	puskesmas.nama_puskesmas as puskesmas,
    kampung.nama_kampung as kampung,
    ROUND(SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03 OR MONTH(data_individu.tanggal_idl) = 04 OR MONTH(data_individu.tanggal_idl) = 05 OR MONTH(data_individu.tanggal_idl) = 06) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END), 0) as idl,
    ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)) as sasaran,
    ((ROUND(SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03 OR MONTH(data_individu.tanggal_idl) = 04 OR MONTH(data_individu.tanggal_idl) = 05 OR MONTH(data_individu.tanggal_idl) = 06) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END))/(ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)))*100, 2)) as ketercapaian,
    (CASE WHEN ((ROUND(SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03 OR MONTH(data_individu.tanggal_idl) = 04 OR MONTH(data_individu.tanggal_idl) = 05 OR MONTH(data_individu.tanggal_idl) = 06) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END))/(ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)))*100, 2)) >= 40 THEN 'UCI' ELSE 'Non-UCI' END), 0) as uci
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung";
        }
        elseif ($quarter == 3) {
            $query = "SELECT kabupaten.nama_kabupaten as kabupaten,
	puskesmas.nama_puskesmas as puskesmas,
    kampung.nama_kampung as kampung,
    ROUND(SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03 OR MONTH(data_individu.tanggal_idl) = 04 OR MONTH(data_individu.tanggal_idl) = 05 OR MONTH(data_individu.tanggal_idl) = 06 OR MONTH(data_individu.tanggal_idl) = 07 OR MONTH(data_individu.tanggal_idl) = 08 OR MONTH(data_individu.tanggal_idl) = 09) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END), 0) as idl,
    ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)) as sasaran,
    ((ROUND(SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03 OR MONTH(data_individu.tanggal_idl) = 04 OR MONTH(data_individu.tanggal_idl) = 05 OR MONTH(data_individu.tanggal_idl) = 06 OR MONTH(data_individu.tanggal_idl) = 07 OR MONTH(data_individu.tanggal_idl) = 08 OR MONTH(data_individu.tanggal_idl) = 09) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END))/(ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)))*100, 2)) as ketercapaian,
    (CASE WHEN ((ROUND(SUM(CASE WHEN data_individu.idl = 1 AND (MONTH(data_individu.tanggal_idl) = 01 OR MONTH(data_individu.tanggal_idl) = 02 OR MONTH(data_individu.tanggal_idl) = 03 OR MONTH(data_individu.tanggal_idl) = 04 OR MONTH(data_individu.tanggal_idl) = 05 OR MONTH(data_individu.tanggal_idl) = 06 OR MONTH(data_individu.tanggal_idl) = 07 OR MONTH(data_individu.tanggal_idl) = 08 OR MONTH(data_individu.tanggal_idl) = 09) AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END))/(ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)))*100, 2)) >= 60 THEN 'UCI' ELSE 'Non-UCI' END), 0) as uci
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung";
        }
        elseif ($quarter == 4) {
            $query = "SELECT kabupaten.nama_kabupaten as kabupaten,
	puskesmas.nama_puskesmas as puskesmas,
    kampung.nama_kampung as kampung,
    ROUND(SUM(CASE WHEN data_individu.idl = 1 AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END), 0) as idl,
    ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)) as sasaran,
    ((ROUND(SUM(CASE WHEN data_individu.idl = 1 AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END))/(ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)))*100, 2)) as ketercapaian,
    (CASE WHEN ((ROUND(SUM(CASE WHEN data_individu.idl = 1 AND YEAR(data_individu.tanggal_idl) = {$tahunForm} THEN 1 ELSE 0 END))/(ROUND((kampung.surviving_infant_L + kampung.surviving_infant_P)))*100, 2)) >= 80 THEN 'UCI' ELSE 'Non-UCI' END), 0) as uci
        FROM kampung
          LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
          LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
          LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
        GROUP BY kampung.id_kampung
        ORDER BY kampung.id_kampung";
        }

        $data = DB::select($query);
        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);

    }
}
