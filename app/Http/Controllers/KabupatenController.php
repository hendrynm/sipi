<?php

namespace App\Http\Controllers;

use App\Models\ProvinsiModel;
use Illuminate\Http\Request;
use App\Models\KabupatenModel;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class KabupatenController extends Controller
{
    public function id_kab()
    {
        return session()->get("id_kabupaten");
    }

    public function dashboard()
    {
        $kueri = (new KabupatenModel)->dashboard($this->id_kab());
        return view("kabupaten.dashboard",["data"=>$kueri]);
    }

    public function dataDashboard(Request $request)
    {
        if ($request->ajax())
        {
            $data = (new KabupatenModel())->dataDashboard($this->id_kab());
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view("kabupaten.dataIndividu.dashboard");
    }

    public function dataDetail($id)
    {
        $kueri = (new KabupatenModel)->dataDetail($id);
        $kueri2 = (new KabupatenModel)->dataDetailImunisasi($id);
        return view("kabupaten.dataIndividu.detailDataIndividu",["data"=>$kueri,"data2"=>$kueri2]);
    }

    public function akunDashboard()
    {
        $kueri = (new KabupatenModel)->akunDashboard($this->id_kab());
        return view("kabupaten.manajemenAkun.dashboard",["data"=>$kueri]);
    }

    public function akunEdit($id)
    {
        $kueri = (new KabupatenModel)->akunEdit($id);
        return view("kabupaten.manajemenAkun.editAkun",["data"=>$kueri]);
    }

    public function akunEditKirim(Request $request)
    {
        (new KabupatenModel)->akunEditKirim($request);
        return redirect("/kabupaten/akun/dashboard");
    }

    public function akunGantiPass($id)
    {
        $kueri = (new KabupatenModel)->akunGantiPass($id);
        return view("kabupaten.manajemenAkun.gantiPassword",["data" => $kueri]);
    }

    public function akunGantiPassKirim(Request $request)
    {
        (new KabupatenModel)->akunGantiPassKirim($request);
        return redirect("/kabupaten/akun/dashboard");
    }

    public function akunTambah()
    {
        return view("kabupaten.manajemenAkun.tambahAkun");
    }

    public function akunTambahKirim(Request $request)
    {
        (new KabupatenModel)->akunTambahKirim($request);
        return redirect("/kabupaten/akun/dashboard");
    }

    public function kampungDashboard()
    {
        $kueri = (new KabupatenModel)->kampungDashboard($this->id_kab());
        return view("kabupaten.regional.dashboard",["data" => $kueri]);
    }

    public function kampungEdit($id)
    {
        $kueri = (new KabupatenModel)->kampungEdit($id);
        return view("kabupaten.regional.editData",["data"=>$kueri]);
    }

    public function kampungEditKirim(Request $request)
    {
        (new KabupatenModel)->kampungEditKirim($request);
        return redirect("/kabupaten/regional-kampung/dashboard");
    }

    public function kampungTambah()
    {
        return view("kabupaten.regional.tambahData");
    }

    public function kampungTambahKirim(Request $request)
    {
        (new KabupatenModel)->kampungTambahKirim($request);
        return redirect("/kabupaten/regional-kampung/dashboard");
    }

    public function posyanduDashboard()
    {
        $kueri = (new KabupatenModel)->posyanduDashboard($this->id_kab());
        return view("kabupaten.regionalPosyandu.dashboard",["data" => $kueri]);
    }

    public function posyanduEdit($id)
    {
        $kueri = (new KabupatenModel)->posyanduEdit($id);
        return view("kabupaten.regionalPosyandu.editData",["data"=>$kueri]);
    }

    public function posyanduEditKirim(Request $request)
    {
        (new KabupatenModel)->posyanduEditKirim($request);
        return redirect("/kabupaten/regional-posyandu/dashboard");
    }

    public function posyanduTambah()
    {
        return view("kabupaten.regionalPosyandu.tambahData");
    }

    public function posyanduTambahKirim(Request $request)
    {
        (new KabupatenModel)->posyanduTambahKirim($request);
        return redirect("/kabupaten/regional-posyandu/dashboard");
    }

    public function puskesmasDashboard()
    {
        $kueri = (new KabupatenModel)->puskesmasDashboard($this->id_kab());
        return view("kabupaten.regionalPuskesmas.dashboard",["data" => $kueri]);
    }

    public function puskesmasEdit($id)
    {
        $kueri = (new KabupatenModel)->puskesmasEdit($id);
        return view("kabupaten.regionalPuskesmas.editData",["data"=>$kueri]);
    }

    public function puskesmasEditKirim(Request $request)
    {
        (new KabupatenModel)->puskesmasEditKirim($request);
        return redirect("/kabupaten/regional-puskesmas/dashboard");
    }

    public function puskesmasTambah()
    {
        return view("kabupaten.regionalPuskesmas.tambahData");
    }

    public function puskesmasTambahKirim(Request $request)
    {
        (new KabupatenModel)->puskesmasTambahKirim($request, $this->id_kab());
        return redirect("/kabupaten/regional-puskesmas/dashboard");
    }

    public function sasaranDashboard(Request $request)
    {
        if ($request->ajax())
        {
            $data = (new KabupatenModel())->sasaranDashboard($this->id_kab());
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view("kabupaten.sasaran.dashboard");
    }
}
