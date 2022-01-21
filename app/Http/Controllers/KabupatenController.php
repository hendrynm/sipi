<?php

namespace App\Http\Controllers;

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

    public function akunTambah()
    {

    }
}
