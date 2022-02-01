<?php

namespace App\Http\Controllers;

use App\Models\EksternalModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EksternalController extends Controller
{
    public function id_kab()
    {
        return session()->get("id_kabupaten");
    }

    public function dashboard()
    {
        return view("eksternal.dashboard");
    }

    public function dataDashboard()
    {
        return view("eksternal.dataIndividu.dashboard");
    }

    public function dataDashboardKirim(Request $request)
    {
        $kueri = (new EksternalModel)->dataDashboardKirim($request);
        return view("eksternal.dataIndividu.dataCari",["data"=>$kueri]);
    }

    public function dataDetail($id)
    {
        $kueri = (new EksternalModel)->dataDetail($id);
        $kueri2 = (new EksternalModel)->dataDetailImunisasi($id);
        return view("eksternal.dataIndividu.detailDataIndividu",["data"=>$kueri,"data2"=>$kueri2]);
    }

    public function dataTambah()
    {
        $kueri = (new EksternalModel)->daftarPosyandu($this->id_kab());
        $kueri2 = (new EksternalModel)->daftarKampung($this->id_kab());
        return view("eksternal.dataIndividu.tambahDataIndividu",["data2"=>$kueri,"data"=>$kueri2]);
    }

    public function dataTambahKirim(Request $request)
    {
        (new EksternalModel)->dataTambahKirim($request);
        return redirect("/eksternal/data-anak/dashboard");
    }

    public function posDashboard()
    {
        return view("eksternal.posyandu.dashboard");
    }

    public function posMulai(Request $request)
    {
        $kueri = (new EksternalModel)->posMulai($request);
        return view("eksternal.posyandu.mulaiPosyandu",["data"=>$kueri]);
    }

    public function posEntri($id)
    {
        $kueri = (new EksternalModel)->dataDetail($id);
        $kueri2 = (new EksternalModel)->dataDetailImunisasi($id);
        $kueri3 = (new EksternalModel)->posEntri($id);
        return view("eksternal.posyandu.entriPosyandu",["data"=>$kueri,"data2"=>$kueri2,"data3"=>$kueri3]);
    }

    public function posEntriKirim(Request $request)
    {
        return redirect("/eksternal/posyandu/dashboard");
    }
}
