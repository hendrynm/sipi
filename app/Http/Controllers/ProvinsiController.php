<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProvinsiModel;

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
        $kueri = ProvinsiModel::antigenDashboard();
        return view("provinsi.antigen.dashboard",["data" => $kueri]);
    }

    public function antigenEdit($id)
    {
        $kueri = ProvinsiModel::antigenEdit($id);
        return view("provinsi.antigen.editAntigen",["data" => $kueri]);
    }

    public function antigenEditKirim(Request $request)
    {
        ProvinsiModel::antigenEditKirim($request);
        return redirect("/provinsi/antigen/dashboard");
    }

    public function antigenTambah()
    {
        return view("provinsi.antigen.tambahAntigen");
    }

    public function antigenTambahKirim(Request $request)
    {
        ProvinsiModel::antigenTambahKirim($request);
        return redirect("/provinsi/antigen/dashboard");
    }

    /*
     * CAPAIAN
     */
    public function capaianKabupaten()
    {
        return view("provinsi.capaian.capaianKabupaten");
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
    public function anakDashboard()
    {
        $kueri = ProvinsiModel::anakDashboard();
        return view("provinsi.dataIndividu.dashboard",["data1" => $kueri]);
    }

    public function anakDetail($id)
    {
        $kueri = ProvinsiModel::anakDetail($id);
        $kueri2 = ProvinsiModel::anakDetailImunisasi($id);
        return view("provinsi.dataIndividu.detailDataIndividu",["data" => $kueri, "data2" => $kueri2]);
    }

    /*
     * MANAJEMEN AKUN
     */
    public function akunDashboard()
    {
        $kueri = ProvinsiModel::akunDashboard();
        return view("provinsi.manajemenAkun.dashboard",["data" => $kueri]);
    }

    public function akunEdit($id)
    {
        $kueri = ProvinsiModel::akunEdit($id);
        return view("provinsi.manajemenAkun.editAkun",["data" => $kueri]);
    }

    public function akunEditKirim(Request $request)
    {
        ProvinsiModel::akunEditKirim($request);
        return redirect("/provinsi/akun/dashboard");
    }

    public function akunGantiPass($id)
    {
        $kueri = ProvinsiModel::akunGantiPass($id);
        return view("provinsi.manajemenAkun.gantiPassword",["data" => $kueri]);
    }

    public function akunGantiPassKirim(Request $request)
    {
        ProvinsiModel::akunGantiPassKirim($request);
        return redirect("/provinsi/akun/dashboard");
    }

    public function akunTambah()
    {
        return view("provinsi.manajemenAkun.tambahAkun");
    }

    public function akunTambahKirim(Request $request)
    {
        ProvinsiModel::akunTambahKirim($request);
        return redirect("/provinsi/akun/dashboard");
    }

    /*
     * REGIONAL KAMPUNG
     */
    public function kampungDashboard()
    {
        $kueri = ProvinsiModel::kampungDashboard();
        return view("provinsi.regional.dashboard",["data" => $kueri]);
    }

    public function kampungEdit($id)
    {
        $kueri = ProvinsiModel::kampungEdit($id);
        $kueri2 = ProvinsiModel::daftarPuskesmas();
        return view("provinsi.regional.editData",["data" => $kueri,"data2" => $kueri2]);
    }

    public function kampungEditKirim(Request $request)
    {
        ProvinsiModel::kampungEditKirim($request);
        return redirect("/provinsi/regional-kampung/dashboard");
    }

    public function kampungTambah()
    {
        $kueri = ProvinsiModel::daftarPuskesmas();
        return view("provinsi.regional.tambahData",["data2"=>$kueri]);
    }

    public function kampungTambahKirim(Request $request)
    {
        ProvinsiModel::kampungTambahKirim($request);
        return redirect("/provinsi/regional-kampung/dashboard");
    }

    /*
     * REGIONAL POSYANDU
     */
    public function posyanduDashboard()
    {
        $kueri = ProvinsiModel::posyanduDashboard();
        return view("provinsi.regionalPosyandu.dashboard",["data" => $kueri]);
    }

    public function posyanduEdit($id)
    {
        $kueri = ProvinsiModel::posyanduEdit($id);
        $kueri2 = ProvinsiModel::daftarKampung();
        return view("provinsi.regionalPosyandu.editData",["data" => $kueri, "data2" => $kueri2]);
    }

    public function posyanduEditKirim(Request $request)
    {
        ProvinsiModel::posyanduEditKirim($request);
        return redirect("/provinsi/regional-posyandu/dashboard");
    }

    public function posyanduTambah()
    {
        $kueri = ProvinsiModel::daftarKampung();
        return view("provinsi.regionalPosyandu.tambahData",["data2"=>$kueri]);
    }

    public function posyanduTambahKirim(Request $request)
    {
        ProvinsiModel::posyanduTambahKirim($request);
        return redirect("/provinsi/regional-posyandu/dashboard");
    }

    public function kabupatenDashboard()
    {
        $kueri = ProvinsiModel::kabupatenDashboard();
        return view("provinsi.regionalKabupaten.dashboard",["data"=>$kueri]);
    }

    public function kabupatenEdit($id)
    {
        $kueri = ProvinsiModel::kabupatenEdit($id);
        return view("provinsi.regionalKabupaten.editData",["data" => $kueri]);
    }

    public function kabupatenEditKirim(Request $request)
    {
        ProvinsiModel::kabupatenEditKirim($request);
        return redirect("/provinsi/regional-kabupaten/dashboard");
    }

    public function kabupatenTambah()
    {
        return view("provinsi.regionalKabupaten.tambahData");
    }

    public function kabupatenTambahKirim(Request $request)
    {
        ProvinsiModel::kabupatenTambahKirim($request);
        return redirect("/provinsi/regional-kabupaten/dashboard");
    }

    public function puskesmasDashboard()
    {
        $kueri = ProvinsiModel::puskesmasDashboard();
        return view("provinsi.regionalPuskesmas.dashboard",["data"=>$kueri]);
    }

    public function puskesmasEdit($id)
    {
        $kueri = ProvinsiModel::puskesmasEdit($id);
        $kueri2 = ProvinsiModel::daftarKabupaten();
        return view("provinsi.regionalPuskesmas.editData",["data" => $kueri, "data2" => $kueri2]);
    }

    public function puskesmasEditKirim(Request $request)
    {
        ProvinsiModel::puskesmasEditKirim($request);
        return redirect("/provinsi/regional-puskesmas/dashboard");
    }

    public function puskesmasTambah()
    {
        $kueri = ProvinsiModel::daftarKabupaten();
        return view("provinsi.regionalPuskesmas.tambahData",["data2"=>$kueri]);
    }

    public function puskesmasTambahKirim(Request $request)
    {
        ProvinsiModel::puskesmasTambahKirim($request);
        return redirect("/provinsi/regional-puskesmas/dashboard");
    }

    public function sasaranDashboard()
    {
        $kueri = ProvinsiModel::sasaranDashboard();
        return view("provinsi.sasaran.dashboard",["data" => $kueri]);
    }

    public function sasaranTarget($id)
    {
        $kueri = ProvinsiModel::sasaranTarget($id);
        return view("provinsi.sasaran.target",["data" => $kueri]);
    }
}
