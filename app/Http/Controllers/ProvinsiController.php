<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    public function __construct()
    {
        if(session()->get("akses") !== 1) redirect("/");
    }

    public function index()
    {
        return view("provinsi.dashboard");
    }

    /*
     * ANTIGEN
     */
    public function antigenDashboard()
    {
        return view("provinsi.antigen.dashboard");
    }

    public function antigenEdit($id)
    {
        return view("provinsi.antigen.editAntigen");
    }

    public function antigenEditKirim(Request $request)
    {
        return ;
    }

    public function antigenTambah()
    {
        return view("provinsi.antigen.tambahAntigen");
    }

    public function antigenTambahKirim(Request $request)
    {

    }

    /*
     * CAPAIAN
     */
    public function capaianKabupaten()
    {
        return view("provinsi.capaian.capaianKabupaten");
    }

    public function capaianKampung($id)
    {
        return view("provinsi.capaian.capaianKampung");
    }

    public function capaianProvinsi($id)
    {
        return view("provinsi.capaian.capaianProvinsi");
    }

    public function capaianPuskesmas($id)
    {
        return view("provinsi.capaian.capaianPuskesmas");
    }

    /*
     * DATA ANAK
     */
    public function anakDashboard()
    {
        return view("provinsi.dataAnak.dashboard");
    }

    public function anakDetail($id)
    {
        return view("provinsi.dataAnak.detailDataAnak");
    }

    /*
     * MANAJEMEN AKUN
     */
    public function akunDashboard()
    {
        return view("provinsi.manajemenAkun.dashboard");
    }

    public function akunEdit($id)
    {
        return view("provinsi.manajemenAkun.editAkun");
    }

    public function akunGantiPass($id)
    {
        return view("provinsi.manajemenAkun.gantiPassword");
    }

    public function akunGantiPassKirim(Request $request)
    {

    }

    public function akunTambah()
    {
        return view("provinsi.manajemenAkun.tambahAkun");
    }

    public function akunTambahKirim(Request $request)
    {

    }

    /*
     * REGIONAL
     */
    public function regionalDashboard()
    {
        return view("provinsi.regional.dashboard");
    }

    public function regionalEdit($id)
    {
        return view("provinsi.regional.editData");
    }

    public function regionalEditKirim(Request $request)
    {

    }

    public function regionalTambah()
    {
        return view("provinsi.regional.tambahData");
    }

    public function regionalTambahKirim(Request $request)
    {

    }
}
