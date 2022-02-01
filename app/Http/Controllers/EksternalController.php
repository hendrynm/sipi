<?php

namespace App\Http\Controllers;

use App\Models\EksternalModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EksternalController extends Controller
{
    public function id_pus()
    {
        return session()->get("id_puskesmas");
    }

    public function dashboard()
    {
        return view("eksternal.dashboard");
    }

    public function dataDashboard(Request $request)
    {
        if ($request->ajax())
        {
            $data = (new EksternalModel())->dataDashboard($this->id_pus());
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view("eksternal.dataIndividu.dashboard");
    }

    public function dataDetail($id)
    {
        $kueri = (new EksternalModel)->dataDetail($id);
        $kueri2 = (new EksternalModel)->dataDetailImunisasi($id);
        return view("eksternal.dataIndividu.detailDataIndividu",["data"=>$kueri,"data2"=>$kueri2]);
    }

    public function dataTambah()
    {
        $kueri = (new EksternalModel)->daftarPosyandu($this->id_pus());
        $kueri2 = (new EksternalModel)->daftarKampung($this->id_pus());
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

    public function posMulaiPilih(Request $request)
    {
        $id = $request->posyandu;
        return redirect("/puskesmas/posyandu/mulai/$id");
    }

    public function posMulai(Request $request, $id)
    {
        return view("eksternal.posyandu.dashboard");
    }

    public function posEntri($id)
    {
        return view("eksternal.posyandu.dashboard");
    }

    public function posEntriKirim(Request $request)
    {
        return redirect("/eksternal/posyandu/dashboard");
    }
}
