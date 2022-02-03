<?php

namespace App\Http\Controllers;

use App\Models\PuskesmasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Tags\Deprecated;
use Yajra\DataTables\DataTables;
use function MongoDB\BSON\toJSON;

class PuskesmasController extends Controller
{

    


    public function id_pus()
    {
        return session()->get("id_puskesmas");
    }

    public function dashboard()
    {
        $kueri = (new PuskesmasModel)->dashboard($this->id_pus());
        return view("puskesmas.dashboard",["data"=>$kueri]);
    }

    public function dataDashboard(Request $request)
    {
        if ($request->ajax())
        {
            $data = (new PuskesmasModel())->dataDashboard($this->id_pus());
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view("puskesmas.dataIndividu.dashboard");
    }

    public function dataDetail($id)
    {
        $kueri = (new PuskesmasModel)->dataDetail($id);
        $kueri2 = (new PuskesmasModel)->dataDetailImunisasi($id);
        return view("puskesmas.dataIndividu.detailDataIndividu",["data"=>$kueri,"data2"=>$kueri2]);
    }

    public function dataEdit($id)
    {
        $kueri = (new PuskesmasModel)->dataEdit($id);
        $kueri2 = (new PuskesmasModel)->daftarPosyandu($this->id_pus());
        return view("puskesmas.dataIndividu.editDataIndividu",["data"=>$kueri,"data2"=>$kueri2]);
    }

    public function dataEditKirim(Request $request)
    {
        (new PuskesmasModel)->dataEditKirim($request);
        return redirect("/puskesmas/data-anak/dashboard");
    }

    public function dataTambah()
    {
        $kueri = (new PuskesmasModel)->daftarPosyandu($this->id_pus());
        $kueri2 = (new PuskesmasModel)->daftarKampung($this->id_pus());
        return view("puskesmas.dataIndividu.tambahDataIndividu",["data2"=>$kueri,"data"=>$kueri2]);
    }

    public function dataTambahKirim(Request $request)
    {
        (new PuskesmasModel)->dataTambahKirim($request);
        return redirect("/puskesmas/data-anak/dashboard");
    }

    public function akunDashboard()
    {
        $kueri = (new PuskesmasModel)->akunDashboard($this->id_pus());
        return view("puskesmas.manajemenAkun.dashboard",["data"=>$kueri]);
    }

    public function akunEdit($id)
    {
        $kueri = (new PuskesmasModel)->akunEdit($id);
        return view("puskesmas.manajemenAkun.editAkun",["data"=>$kueri]);
    }

    public function akunEditKirim(Request $request)
    {
        (new PuskesmasModel)->akunEditKirim($request);
        return redirect("/puskesmas/akun/dashboard");
    }

    public function akunGantiPass($id)
    {
        $kueri = (new PuskesmasModel)->akunGantiPass($id);
        return view("puskesmas.manajemenAkun.gantiPassword",["data" => $kueri]);
    }

    public function akunGantiPassKirim(Request $request)
    {
        (new PuskesmasModel)->akunGantiPassKirim($request);
        return redirect("/puskesmas/akun/dashboard");
    }

    public function akunTambah()
    {
        return view("puskesmas.manajemenAkun.tambahAkun");
    }

    public function akunTambahKirim(Request $request)
    {
        (new PuskesmasModel)->akunTambahKirim($request);
        return redirect("/puskesmas/akun/dashboard");
    }

    public function akunHapusKirim($id)
    {
        (new PuskesmasModel)->akunHapusKirim($id);
        return redirect("/puskesmas/akun/dashboard");
    }

    public function kampungDashboard(Request $request)
    {
        if ($request->ajax())
        {
            $data = (new PuskesmasModel)->kampungDashboard($this->id_pus());
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view("puskesmas.regional.dashboard");
    }

    public function kampungEdit($id)
    {
        $kueri = (new PuskesmasModel)->kampungEdit($id);
        return view("puskesmas.regional.editData",["data"=>$kueri]);
    }

    public function kampungEditKirim(Request $request)
    {
        (new PuskesmasModel)->kampungEditKirim($request);
        return redirect("/puskesmas/regional-kampung/dashboard");
    }

    public function kampungTambah()
    {
        $kueri = (new PuskesmasModel)->daftarPuskesmas($this->id_pus());
        return view("puskesmas.regional.tambahData",["data2"=>$kueri]);
    }

    public function kampungTambahKirim(Request $request)
    {
        (new PuskesmasModel)->kampungTambahKirim($request, $this->id_pus());
        return redirect("/puskesmas/regional-kampung/dashboard");
    }

    public function kampungSasaranDetail($id)
    {
        $kueri = (new PuskesmasModel)->kampungSasaranDetail($id);
        return view("puskesmas.regional.target",["data"=>$kueri]);
    }

    public function kampungSasaranUbah($id)
    {
        $kueri = (new PuskesmasModel)->kampungSasaranUbah($id);
        return view("puskesmas.regional.ubah",["data"=>$kueri]);
    }

    public function kampungSasaranUbahKirim(Request $request)
    {
        (new PuskesmasModel)->kampungSasaranUbahKirim($request);
        return redirect("/puskesmas/regional-kampung/dashboard");
    }

    public function posyanduDashboard(Request $request)
    {
        if ($request->ajax())
        {
            $data = (new PuskesmasModel)->posyanduDashboard($this->id_pus());
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view("puskesmas.regionalPosyandu.dashboard");
    }

    public function posyanduEdit($id)
    {
        $kueri = (new PuskesmasModel)->posyanduEdit($id);
        $kueri2 = (new PuskesmasModel)->daftarKampung($this->id_pus());
        return view("puskesmas.regionalPosyandu.editData",["data"=>$kueri,"data2"=>$kueri2]);
    }

    public function posyanduEditKirim(Request $request)
    {
        (new PuskesmasModel)->posyanduEditKirim($request);
        return redirect("/puskesmas/regional-posyandu/dashboard");
    }

    public function posyanduTambah()
    {
        $kueri = (new PuskesmasModel)->daftarKampung($this->id_pus());
        return view("puskesmas.regionalPosyandu.tambahData",["data2"=>$kueri]);
    }

    public function posyanduTambahKirim(Request $request)
    {
        (new PuskesmasModel)->posyanduTambahKirim($request);
        return redirect("/puskesmas/regional-posyandu/dashboard");
    }

    public function posDashboard()
    {
        $kueri = (new PuskesmasModel)->daftarPosyandu($this->id_pus());
        return view("puskesmas.posyandu.dashboard",["data"=>$kueri]);
    }

    public function posBelumImunisasi()
    {
        $kueri = (new PuskesmasModel)->daftarPosyandu($this->id_pus());
        return view("puskesmas.posyandu.belumImunisasi",["data2"=>$kueri]);
    }

    public function posBelumImunisasiCari(Request $request, $id)
    {
        if ($request->ajax())
        {
            $data = (new PuskesmasModel)->posBelumImunisasi($id, $this->id_pus());
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view("puskesmas.posyandu.belumImunisasiCari");
    }

    public function posMulaiPilih(Request $request)
    {
        $id = $request->posyandu;
        return redirect("/puskesmas/posyandu/mulai/$id");
    }

    public function posMulai(Request $request, $id)
    {
        if ($request->ajax())
        {
            $data = (new PuskesmasModel)->posMulai($id);
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view("puskesmas.posyandu.mulaiPosyandu");
    }

    public function posEntri($id)
    {
        $kueri = (new PuskesmasModel)->dataDetail($id);
        $kueri2 = (new PuskesmasModel)->dataDetailImunisasi($id);
        $kueri3 = (new PuskesmasModel)->posEntri($id);
        return view("puskesmas.posyandu.entriPosyandu",["data"=>$kueri,"data2"=>$kueri2],["data3"=>$kueri3]);
    }

    public function posEntriKirim(Request $request)
    {
        (new PuskesmasModel)->posEntriKirim($request);
        return redirect("/puskesmas/posyandu/dashboard");
    }

    public function getListPuskesmasByKabupatenId($id)
    {
        $pus = DB::table("puskesmas")
            ->where("id_kabupaten",$id)->pluck('id_puskesmas','nama_puskesmas');

        return response()->json($pus);
    }
}
