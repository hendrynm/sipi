<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProvinsiModel;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ProvinsiController extends Controller
{
    public function index()
    {
        return view("provinsi.dashboard");
    }

    /*
     * ANTIGEN
     */
    public function antigenDashboard()
    {
        $kueri = (new ProvinsiModel)->antigenDashboard();
        return view("provinsi.antigen.dashboard",["data" => $kueri]);
    }

    public function antigenEdit($id)
    {
        $kueri = (new ProvinsiModel)->antigenEdit($id);
        return view("provinsi.antigen.editAntigen",["data" => $kueri]);
    }

    public function antigenEditKirim(Request $request)
    {
        $kueri = (new ProvinsiModel)->antigenEditKirim($request);
        if($kueri > 0)
        {
            return redirect("/provinsi/antigen/dashboard")->with("sukses","Data Antigen berhasil disimpan");
        }
        return redirect("/provinsi/antigen/dashboard")->with("gagal","Data Antigen gagal disimpan");
    }

    public function antigenTambah()
    {
        return view("provinsi.antigen.tambahAntigen");
    }

    public function antigenTambahKirim(Request $request)
    {
        $kueri = (new ProvinsiModel)->antigenTambahKirim($request);
        if($kueri > 0)
        {
            return redirect("/provinsi/antigen/dashboard")->with("sukses","Data Antigen berhasil disimpan");
        }
        return redirect("/provinsi/antigen/dashboard")->with("gagal","Data Antigen gagal disimpan");

    }

    /*
     * DATA ANAK
     */
    public function anakDashboard(Request $request)
    {
        if ($request->ajax()) {
            $data = (new ProvinsiModel)->anakDashboard();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view("provinsi.dataIndividu.dashboard");
    }

    public function anakDetail($id)
    {
        $kueri = (new ProvinsiModel)->anakDetail($id);
        $kueri2 = (new ProvinsiModel)->anakDetailImunisasi($id);
        return view("provinsi.dataIndividu.detailDataIndividu",["data" => $kueri, "data2" => $kueri2]);
    }

    /*
     * MANAJEMEN AKUN
     */
    public function akunDashboard()
    {
        $kueri = (new ProvinsiModel)->akunDashboard();
        return view("provinsi.manajemenAkun.dashboard",["data" => $kueri]);
    }

    public function akunEdit($id)
    {
        $kueri = (new ProvinsiModel)->akunEdit($id);
        return view("provinsi.manajemenAkun.editAkun",["data" => $kueri]);
    }

    public function akunEditKirim(Request $request)
    {
        $kueri = (new ProvinsiModel)->akunEditKirim($request);
        if($kueri > 0)
        {
            return redirect("/provinsi/akun/dashboard")->with("sukses","Data berhasil disimpan");
        }
        return redirect("/provinsi/akun/dashboard")->with("gagal","Data gagal disimpan");
    }

    public function akunGantiPass($id)
    {
        $kueri = (new ProvinsiModel)->akunGantiPass($id);
        return view("provinsi.manajemenAkun.gantiPassword",["data" => $kueri]);
    }

    public function akunGantiPassKirim(Request $request)
    {
        $kueri = (new ProvinsiModel)->akunGantiPassKirim($request);
        if($kueri > 0)
        {
            return redirect("/provinsi/akun/dashboard")->with("sukses","Password berhasil diubah");
        }
        return redirect("/provinsi/akun/dashboard")->with("gagal","Password gagal diubah");
    }

    public function akunTambah()
    {
        return view("provinsi.manajemenAkun.tambahAkun");
    }

    public function akunTambahKirim(Request $request)
    {
        @dd($request->all());
        $kueri = (new ProvinsiModel)->akunTambahKirim($request);
        if($kueri > 0)
        {
            return redirect("/provinsi/akun/dashboard")->with("sukses","Akun baru berhasil ditambahkan");
        }
        return redirect("/provinsi/akun/dashboard")->with("gagal","Akun baru gagal ditambahkan");
    }

    public function akunHapusKirim($id)
    {
        (new ProvinsiModel)->akunHapusKirim($id);
        return redirect("/provinsi/akun/dashboard")->with("sukses","Akun berhasil dihapus");
    }

    /*
     * REGIONAL KAMPUNG
     */
    public function kampungDashboard(Request $request)
    {
        if ($request->ajax()) {
            $data = (new ProvinsiModel)->kampungDashboard();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view("provinsi.regional.dashboard");
    }

    public function kampungEdit($id)
    {
        $kueri = (new ProvinsiModel)->kampungEdit($id);
        $kueri2 = (new ProvinsiModel)->daftarPuskesmas();
        return view("provinsi.regional.editData",["data" => $kueri,"data2" => $kueri2]);
    }

    public function kampungEditKirim(Request $request)
    {
        $kueri = (new ProvinsiModel)->kampungEditKirim($request);
        if($kueri > 0)
        {
            return redirect("/provinsi/regional-kampung/dashboard")->with("sukses","Data Kampung berhasil disimpan");
        }
        return redirect("/provinsi/regional-kampung/dashboard")->with("gagal","Data Kampung gagal disimpan");
    }

    public function kampungTambah()
    {
        $kueri = (new ProvinsiModel)->daftarPuskesmas();
        return view("provinsi.regional.tambahData",["data2"=>$kueri]);
    }

    public function kampungTambahKirim(Request $request)
    {
        $kueri = (new ProvinsiModel)->kampungTambahKirim($request);
        if($kueri > 0)
        {
            return redirect("/provinsi/regional-kampung/dashboard")->with("sukses","Data Kampung berhasil disimpan");
        }
        return redirect("/provinsi/regional-kampung/dashboard")->with("gagal","Data Kampung gagal disimpan");
    }

    /*
     * REGIONAL POSYANDU
     */
    public function posyanduDashboard(Request $request)
    {
        if ($request->ajax()) {
            $data = (new ProvinsiModel)->posyanduDashboard();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view("provinsi.regionalPosyandu.dashboard");
    }

    public function posyanduEdit($id)
    {
        $kueri = (new ProvinsiModel)->posyanduEdit($id);
        $kueri2 = (new ProvinsiModel)->daftarKampung();
        return view("provinsi.regionalPosyandu.editData",["data" => $kueri, "data2" => $kueri2]);
    }

    public function posyanduEditKirim(Request $request)
    {
        $kueri = (new ProvinsiModel)->posyanduEditKirim($request);
        if($kueri > 0)
        {
            return redirect("/provinsi/regional-posyandu/dashboard")->with("sukses","Data Posyandu berhasil disimpan");
        }
        return redirect("/provinsi/regional-posyandu/dashboard")->with("gagal","Data Posyandu gagal disimpan");
    }

    public function posyanduTambah()
    {
        $kueri = (new ProvinsiModel)->daftarKampung();
        return view("provinsi.regionalPosyandu.tambahData",["data2"=>$kueri]);
    }

    public function posyanduTambahKirim(Request $request)
    {
        $kueri = (new ProvinsiModel)->posyanduTambahKirim($request);
        if($kueri > 0)
        {
            return redirect("/provinsi/regional-posyandu/dashboard")->with("sukses","Data Posyandu berhasil disimpan");
        }
        return redirect("/provinsi/regional-posyandu/dashboard")->with("gagal","Data Posyandu gagal disimpan");
    }

    public function kabupatenDashboard()
    {
        $kueri = (new ProvinsiModel)->kabupatenDashboard();
        return view("provinsi.regionalKabupaten.dashboard",["data"=>$kueri]);
    }

    public function kabupatenEdit($id)
    {
        $kueri = (new ProvinsiModel)->kabupatenEdit($id);
        return view("provinsi.regionalKabupaten.editData",["data" => $kueri]);
    }

    public function kabupatenEditKirim(Request $request)
    {
        $kueri = (new ProvinsiModel)->kabupatenEditKirim($request);
        if($kueri > 0)
        {
            return redirect("/provinsi/regional-kabupaten/dashboard")->with("sukses","Data Kabupaten berhasil disimpan");
        }
        return redirect("/provinsi/regional-kabupaten/dashboard")->with("gagal","Data Kabupaten gagal disimpan");
    }

    public function kabupatenTambah()
    {
        return view("provinsi.regionalKabupaten.tambahData");
    }

    public function kabupatenTambahKirim(Request $request)
    {
        $kueri = (new ProvinsiModel)->kabupatenTambahKirim($request);
        if($kueri > 0)
        {
            return redirect("/provinsi/regional-kabupaten/dashboard")->with("sukses","Data Kabupaten berhasil disimpan");
        }
        return redirect("/provinsi/regional-kabupaten/dashboard")->with("gagal","Data Kabupaten gagal disimpan");
    }

    public function puskesmasDashboard(Request $request)
    {
        if ($request->ajax()) {
            $data = (new ProvinsiModel)->puskesmasDashboard();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view("provinsi.regionalPuskesmas.dashboard");
    }

    public function puskesmasEdit($id)
    {
        $kueri = (new ProvinsiModel)->puskesmasEdit($id);
        $kueri2 = (new ProvinsiModel)->daftarKabupaten();
        return view("provinsi.regionalPuskesmas.editData",["data" => $kueri, "data2" => $kueri2]);
    }

    public function puskesmasEditKirim(Request $request)
    {
        $kueri = (new ProvinsiModel)->puskesmasEditKirim($request);
        if($kueri > 0)
        {
            return redirect("/provinsi/regional-puskesmas/dashboard")->with("sukses","Data Puskesmas berhasil disimpan");
        }
        return redirect("/provinsi/regional-puskesmas/dashboard")->with("gagal","Data Puskesmas gagal disimpan");
    }

    public function puskesmasTambah()
    {
        $kueri = (new ProvinsiModel)->daftarKabupaten();
        return view("provinsi.regionalPuskesmas.tambahData",["data2"=>$kueri]);
    }

    public function puskesmasTambahKirim(Request $request)
    {
        $kueri = (new ProvinsiModel)->puskesmasTambahKirim($request);
        if($kueri > 0)
        {
            return redirect("/provinsi/regional-puskesmas/dashboard")->with("sukses","Data Puskesmas berhasil disimpan");
        }
        return redirect("/provinsi/regional-puskesmas/dashboard")->with("gagal","Data Puskesmas gagal disimpan");
    }

    public function sasaranDashboard(Request $request)
    {
        if ($request->ajax()) {
            $data = (new ProvinsiModel)->sasaranDashboard();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view("provinsi.sasaran.dashboard");
    }

    public function sasaranTarget($id)
    {
        $kueri = (new ProvinsiModel)->sasaranTarget($id);
        return view("provinsi.sasaran.target",["data" => $kueri]);
    }
}
