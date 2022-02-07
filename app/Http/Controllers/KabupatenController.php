<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KabupatenModel;
use Illuminate\Support\Facades\DB;
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

    public function dataPindah($id)
    {
        $kueri = (new KabupatenModel)->dataDetail($id);
        $kueri2 = (new KabupatenModel)->daftarKabupatenAll();
        $kueri3 = (new KabupatenModel)->daftarPosyanduAll();
        return view("kabupaten.dataIndividu.pindahKota",["data"=>$kueri,"data2"=>$kueri2,"data3"=>$kueri3]);
    }

    public function dataPindahKirim(Request $request)
    {
        $kueri = (new KabupatenModel)->dataPindahKirim($request);
        if($kueri > 0)
        {
            return redirect("/kabupaten/data/dashboard")->with("sukses","Data Pindah Domisili berhasil disimpan");
        }
        return redirect("/kabupaten/data/dashboard")->with("gagal","Data Pindah Domisili gagal disimpan");
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
        $kueri = (new KabupatenModel)->akunEditKirim($request, $this->id_kab());
        if($kueri > 0)
        {
            return redirect("/kabupaten/akun/dashboard")->with("sukses","Data Akun berhasil disimpan");
        }
        return redirect("/kabupaten/akun/dashboard")->with("gagal","Data Akun gagal disimpan");
    }

    public function akunGantiPass($id)
    {
        $kueri = (new KabupatenModel)->akunGantiPass($id);
        return view("kabupaten.manajemenAkun.gantiPassword",["data" => $kueri]);
    }

    public function akunGantiPassKirim(Request $request)
    {
        $kueri = (new KabupatenModel)->akunGantiPassKirim($request);
        if($kueri > 0)
        {
            return redirect("/kabupaten/akun/dashboard")->with("sukses","Password baru berhasil disimpan");
        }
        return redirect("/kabupaten/akun/dashboard")->with("gagal","Password baru gagal disimpan");
    }

    public function akunTambah()
    {
        return view("kabupaten.manajemenAkun.tambahAkun");
    }

    public function akunTambahKirim(Request $request)
    {
        $kueri = (new KabupatenModel)->akunTambahKirim($request, $this->id_kab());
        if($kueri > 0)
        {
            return redirect("/kabupaten/akun/dashboard")->with("sukses","Data Akun berhasil disimpan");
        }
        return redirect("/kabupaten/akun/dashboard")->with("gagal","Data Akun gagal disimpan");
    }

    public function akunHapusKirim($id)
    {
        $kueri = (new KabupatenModel)->akunHapusKirim($id);
        if($kueri > 0)
        {
            return redirect("/kabupaten/akun/dashboard")->with("sukses","Data Akun berhasil dihapus");
        }
        return redirect("/kabupaten/akun/dashboard")->with("gagal","Data Akun gagal dihapus");
    }

    public function kampungDashboard(Request $request)
    {
        if ($request->ajax())
        {
            $data = (new KabupatenModel)->kampungDashboard($this->id_kab());
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view("kabupaten.regional.dashboard");
    }

    public function kampungEdit($id)
    {
        $kueri = (new KabupatenModel)->kampungEdit($id);
        $kueri2 = (new KabupatenModel)->daftarPuskesmas($this->id_kab());
        return view("kabupaten.regional.editData",["data"=>$kueri,"data2"=>$kueri2]);
    }

    public function kampungEditKirim(Request $request)
    {
        $kueri = (new KabupatenModel)->kampungEditKirim($request);
        if($kueri > 0)
        {
            return redirect("/kabupaten/regional-kampung/dashboard")->with("sukses","Data Kampung berhasil disimpan");
        }
        return redirect("/kabupaten/regional-kampung/dashboard")->with("gagal","Data Kampung gagal disimpan");
    }

    public function kampungTambah()
    {
        $kueri = (new KabupatenModel)->daftarPuskesmas($this->id_kab());
        return view("kabupaten.regional.tambahData",["data2"=>$kueri]);
    }

    public function kampungTambahKirim(Request $request)
    {
        $kueri = (new KabupatenModel)->kampungTambahKirim($request);
        if($kueri > 0)
        {
            return redirect("/kabupaten/regional-kampung/dashboard")->with("sukses","Data Kampung berhasil disimpan");
        }
        return redirect("/kabupaten/regional-kampung/dashboard")->with("gagal","Data Kampung gagal disimpan");
    }

    public function posyanduDashboard()
    {
        $kueri = (new KabupatenModel)->posyanduDashboard($this->id_kab());
        return view("kabupaten.regionalPosyandu.dashboard",["data" => $kueri]);
    }

    public function posyanduEdit($id)
    {
        $kueri = (new KabupatenModel)->posyanduEdit($id);
        $kueri2 = (new KabupatenModel)->daftarKampung($this->id_kab());
        return view("kabupaten.regionalPosyandu.editData",["data"=>$kueri,"data2"=>$kueri2]);
    }

    public function posyanduEditKirim(Request $request)
    {
        $kueri = (new KabupatenModel)->posyanduEditKirim($request);
        if($kueri > 0)
        {
            return redirect("/kabupaten/regional-posyandu/dashboard")->with("sukses","Data Posyandu berhasil disimpan");
        }
        return redirect("/kabupaten/regional-posyandu/dashboard")->with("gagal","Data Posyandu gagal disimpan");
    }

    public function posyanduTambah()
    {
        $kueri = (new KabupatenModel)->daftarKampung($this->id_kab());
        return view("kabupaten.regionalPosyandu.tambahData",["data2"=>$kueri]);
    }

    public function posyanduTambahKirim(Request $request)
    {
        $kueri = (new KabupatenModel)->posyanduTambahKirim($request);
        if($kueri > 0)
        {
            return redirect("/kabupaten/regional-posyandu/dashboard")->with("sukses","Data Posyandu berhasil disimpan");
        }
        return redirect("/kabupaten/regional-posyandu/dashboard")->with("gagal","Data Posyandu gagal disimpan");
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
        $kueri = (new KabupatenModel)->puskesmasEditKirim($request);
        if($kueri > 0)
        {
            return redirect("/kabupaten/regional-puskesmas/dashboard")->with("sukses","Data Puskesmas berhasil disimpan");
        }
        return redirect("/kabupaten/regional-puskesmas/dashboard")->with("gagal","Data Puskesmas gagal disimpan");
    }

    public function puskesmasTambah()
    {
        return view("kabupaten.regionalPuskesmas.tambahData");
    }

    public function puskesmasTambahKirim(Request $request)
    {
        $kueri = (new KabupatenModel)->puskesmasTambahKirim($request, $this->id_kab());
        if($kueri > 0)
        {
            return redirect("/kabupaten/regional-puskesmas/dashboard")->with("sukses","Data Puskesmas berhasil disimpan");
        }
        return redirect("/kabupaten/regional-puskesmas/dashboard")->with("gagal","Data Puskesmas gagal disimpan");
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

    public function sasaranTarget($id)
    {
        $kueri = (new KabupatenModel)->sasaranTarget($id);
        return view("kabupaten.sasaran.target",["data"=>$kueri]);
    }

    public function getListKabupaten()
    {
        $kab = DB::table("kabupaten")
           ->pluck('id_kabupaten','nama_kabupaten');

        return response()->json($kab);
    }
}
