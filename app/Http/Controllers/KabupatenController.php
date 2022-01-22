<?php

namespace App\Http\Controllers;

use App\Models\ProvinsiModel;
use Illuminate\Http\Request;
use App\Models\KabupatenModel;
use Illuminate\Support\Facades\Session;

class KabupatenController extends Controller
{
    public function id_kab()
    {
        return session()->get("id_kabupaten");
    }

    public function dashboard()
    {
        $kueri = KabupatenModel::dashboard($this->id_kab());
        return view("kabupaten.dashboard",["data"=>$kueri]);
    }

    public function dataDashboard()
    {
        $kueri = KabupatenModel::dataDashboard($this->id_kab());
        return view("kabupaten.dataIndividu.dashboard",["data"=>$kueri]);
    }

    public function dataDetail($id)
    {
        $kueri = KabupatenModel::dataDetail($id);
        $kueri2 = KabupatenModel::dataDetailImunisasi($id);
        return view("kabupaten.dataIndividu.detailDataIndividu",["data"=>$kueri,"data2"=>$kueri2]);
    }

    public function akunDashboard()
    {
        $kueri = KabupatenModel::akunDashboard($this->id_kab());
        return view("kabupaten.manajemenAkun.dashboard",["data"=>$kueri]);
    }

    public function akunEdit($id)
    {
        $kueri = KabupatenModel::akunEdit($id);
        return view("kabupaten.manajemenAkun.editAkun",["data"=>$kueri]);
    }

    public function akunEditKirim(Request $request)
    {
        KabupatenModel::akunEditKirim($request);
        return redirect("/kabupaten/akun/dashboard");
    }

    public function akunGantiPass($id)
    {
        $kueri = KabupatenModel::akunGantiPass($id);
        return view("kabupaten.manajemenAkun.gantiPassword",["data" => $kueri]);
    }

    public function akunGantiPassKirim(Request $request)
    {
        KabupatenModel::akunGantiPassKirim($request);
        return redirect("/kabupaten/akun/dashboard");
    }

    public function akunTambah()
    {
        return view("kabupaten.manajemenAkun.tambahAkun");
    }

    public function akunTambahKirim(Request $request)
    {
        KabupatenModel::akunTambahKirim($request);
        return redirect("/kabupaten/akun/dashboard");
    }

    public function kampungDashboard()
    {
        $kueri = KabupatenModel::kampungDashboard($this->id_kab());
        return view("kabupaten.regional.dashboard",["data" => $kueri]);
    }

    public function kampungEdit($id)
    {
        $kueri = KabupatenModel::kampungEdit($id);
        return view("kabupaten.regional.editData",["data"=>$kueri]);
    }

    public function kampungEditKirim(Request $request)
    {
        KabupatenModel::kampungEditKirim($request);
        return redirect("/kabupaten/regional-kampung/dashboard");
    }

    public function kampungTambah()
    {
        return view("kabupaten.regional.tambahData");
    }

    public function kampungTambahKirim(Request $request)
    {
        KabupatenModel::kampungTambahKirim($request);
        return redirect("/kabupaten/regional-kampung/dashboard");
    }

    public function posyanduDashboard()
    {
        $kueri = KabupatenModel::posyanduDashboard($this->id_kab());
        return view("kabupaten.regionalPosyandu.dashboard",["data" => $kueri]);
    }

    public function posyanduEdit($id)
    {
        $kueri = KabupatenModel::posyanduEdit($id);
        return view("kabupaten.regionalPosyandu.editData",["data"=>$kueri]);
    }

    public function posyanduEditKirim(Request $request)
    {
        KabupatenModel::posyanduEditKirim($request);
        return redirect("/kabupaten/regional-posyandu/dashboard");
    }

    public function posyanduTambah()
    {
        return view("kabupaten.regionalPosyandu.tambahData");
    }

    public function posyanduTambahKirim(Request $request)
    {
        KabupatenModel::posyanduTambahKirim($request);
        return redirect("/kabupaten/regional-posyandu/dashboard");
    }
}
