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

    public function id_kab()
    {
        return session()->get("id_kabupaten");
    }

    public function cekStatus($id)
    {
        $kueri1 = (new PuskesmasModel)->cekIDL($id);
        if($kueri1 > 0)
        {
            (new PuskesmasModel)->ubahIDL($id);
        }

        $kueri2 = (new PuskesmasModel)->cekIRL($id);
        if($kueri2 > 0)
        {
            (new PuskesmasModel)->ubahIRL($id);
        }

        $kueri3 = (new PuskesmasModel)->cekT($id);
        if($kueri3 > 0)
        {
            (new PuskesmasModel)->ubahT($id, $kueri3);
        }
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

    public function dataCetakIDL($id)
    {
        $kueri = (new PuskesmasModel)->dataDetail($id);
        $kueri2 = (new PuskesmasModel)->dataDetailImunisasiIDL($id);
        return view("puskesmas.dataIndividu.sertifIDL",["data"=>$kueri,"data2"=>$kueri2]);
    }

    public function dataCetakIRL($id)
    {
        $kueri = (new PuskesmasModel)->dataDetail($id);
        $kueri2 = (new PuskesmasModel)->dataDetailImunisasiIRL($id);
        return view("puskesmas.dataIndividu.sertifIRL",["data"=>$kueri,"data2"=>$kueri2]);
    }

    public function dataEdit($id)
    {
        $kueri = (new PuskesmasModel)->dataEdit($id);
        $kueri2 = (new PuskesmasModel)->daftarPosyandu($this->id_pus());
        return view("puskesmas.dataIndividu.editDataIndividu",["data"=>$kueri,"data2"=>$kueri2]);
    }

    public function dataEditKirim(Request $request)
    {
        $kueri = (new PuskesmasModel)->dataEditKirim($request);
        if($kueri > 0)
        {
            return redirect("/puskesmas/data-anak/dashboard")->with("sukses","Data Individu berhasil disimpan");
        }
        return redirect("/puskesmas/data-anak/dashboard")->with("gagal","Data Individu gagal disimpan");
    }

    public function dataTambah()
    {
        $kueri = (new PuskesmasModel)->daftarPosyandu($this->id_pus());
        $kueri2 = (new PuskesmasModel)->daftarKampung($this->id_pus());
        return view("puskesmas.dataIndividu.tambahDataIndividu",["data2"=>$kueri,"data"=>$kueri2]);
    }

    public function dataTambahKirim(Request $request)
    {
        $kueri = (new PuskesmasModel)->dataTambahKirim($request);
        if($kueri > 0)
        {
            return redirect("/puskesmas/data-anak/detail/$kueri")->with("sukses","Data berhasil disimpan");
        }
        if($kueri === 0)
        {
            return redirect("/puskesmas/data-anak/tambah")->with("gagal","Data gagal disimpan, mohon pperiksa kembali");
        }
        return redirect("/puskesmas/data-anak/tambah")->with("gagal","Data Individu sudah ada. Data baru gagal disimpan");
    }

    public function dataKonfirmasi($id)
    {
        $kueri = (new PuskesmasModel)->dataKonfirmasi($id);
        return view("puskesmas.dataIndividu.konfirmasiHapus",["data"=>$kueri]);
    }

    public function dataHapus($id)
    {
        $kueri = (new PuskesmasModel)->dataHapus($id);
        if($kueri > 0)
        {
            return redirect("/puskesmas/data-anak/dashboard")->with("sukses","Data berhasil dihapus");
        }
        return redirect("/puskesmas/data-anak/dashboard")->with("gagal","Data gagal dihapus");
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
        $kueri = (new PuskesmasModel)->akunEditKirim($request, $this->id_pus(), $this->id_kab());
        if($kueri > 0)
        {
            return redirect("/puskesmas/akun/dashboard")->with("sukses","Data akun berhasil disimpan");
        }
        return redirect("/puskesmas/akun/dashboard")->with("gagal","Data akun gagal disimpan");
    }

    public function akunGantiPass($id)
    {
        $kueri = (new PuskesmasModel)->akunGantiPass($id);
        return view("puskesmas.manajemenAkun.gantiPassword",["data" => $kueri]);
    }

    public function akunGantiPassKirim(Request $request)
    {
        $kueri = (new PuskesmasModel)->akunGantiPassKirim($request);
        if($kueri > 0)
        {
            return redirect("/puskesmas/akun/dashboard")->with("sukses","Password akun berhasil disimpan");
        }
        return redirect("/puskesmas/akun/dashboard")->with("gagal","Password akun gagal disimpan");
    }

    public function akunTambah()
    {
        return view("puskesmas.manajemenAkun.tambahAkun");
    }

    public function akunTambahKirim(Request $request)
    {
        $kueri = (new PuskesmasModel)->akunTambahKirim($request, $this->id_pus(), $this->id_kab());
        if($kueri > 0)
        {
            return redirect("/puskesmas/akun/dashboard")->with("sukses","Data akun berhasil disimpan");
        }
        return redirect("/puskesmas/akun/dashboard")->with("gagal","Data akun gagal disimpan");
    }

    public function akunHapusKirim($id)
    {
        $kueri = (new PuskesmasModel)->akunHapusKirim($id);
        if($kueri > 0)
        {
            return redirect("/puskesmas/akun/dashboard")->with("sukses","Data akun berhasil dihapus");
        }
        return redirect("/puskesmas/akun/dashboard")->with("gagal","Data akun gagal dihapus");
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
        $kueri = (new PuskesmasModel)->kampungEditKirim($request);
        if($kueri > 0)
        {
            return redirect("/puskesmas/regional-kampung/dashboard")->with("sukses","Data Kampung berhasil disimpan");
        }
        return redirect("/puskesmas/regional-kampung/dashboard")->with("gagal","Data Kampung gagal disimpan");
    }

    public function kampungTambah()
    {
        $kueri = (new PuskesmasModel)->daftarPuskesmas($this->id_pus());
        return view("puskesmas.regional.tambahData",["data2"=>$kueri]);
    }

    public function kampungTambahKirim(Request $request)
    {
        $kueri = (new PuskesmasModel)->kampungTambahKirim($request, $this->id_pus());
        if($kueri > 0)
        {
            return redirect("/puskesmas/regional-kampung/dashboard")->with("sukses","Data Kampung berhasil disimpan");
        }
        return redirect("/puskesmas/regional-kampung/dashboard")->with("gagal","Data Kampung gagal disimpan");
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
        $kueri = (new PuskesmasModel)->kampungSasaranUbahKirim($request);
        if($kueri > 0)
        {
            return redirect("/puskesmas/regional-kampung/sasaran/$request->idKampung")->with("sukses","Data Sasaran berhasil disimpan");
        }
        return redirect("/puskesmas/regional-kampung/sasaran/$request->idKampungg")->with("gagal","Data Sasaran gagal disimpan");
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
        $kueri = (new PuskesmasModel)->posyanduEditKirim($request);
        if($kueri > 0)
        {
            return redirect("/puskesmas/regional-posyandu/dashboard")->with("sukses","Data Posyandu berhasil disimpan");
        }
        return redirect("/puskesmas/regional-posyandu/dashboard")->with("gagal","Data Posyandu gagal disimpan");
    }

    public function posyanduTambah()
    {
        $kueri = (new PuskesmasModel)->daftarKampung($this->id_pus());
        return view("puskesmas.regionalPosyandu.tambahData",["data2"=>$kueri]);
    }

    public function posyanduTambahKirim(Request $request)
    {
        $kueri = (new PuskesmasModel)->posyanduTambahKirim($request);
        if($kueri > 0)
        {
            return redirect("/puskesmas/regional-posyandu/dashboard")->with("sukses","Data Posyandu berhasil disimpan");
        }
        return redirect("/puskesmas/regional-posyandu/dashboard")->with("gagal","Data Posyandu gagal disimpan");
    }

    public function posDashboard()
    {
        $kueri = (new PuskesmasModel)->daftarPosyandu($this->id_pus());
        $kueri2 = (new PuskesmasModel)->daftarAntigen();
        return view("puskesmas.posyandu.dashboard",["data"=>$kueri,"data2"=>$kueri2]);
    }

    public function posLaporanCari(Request $request)
    {
        $id = $request->antigen;
        return redirect("/puskesmas/posyandu/laporan/$id");
    }

    public function posLaporan(Request $request, $id)
    {
        if ($request->ajax())
        {
            $data = (new PuskesmasModel)->posLaporan($id, $this->id_pus());
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view("puskesmas.posyandu.belumImunisasiCari");
    }

    public function posLaporanNamaAntigen($id)
    {
        return (new PuskesmasModel)->namaAntigen($id);
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
        $this->cekStatus($request->idAnak);
        return redirect("/puskesmas/posyandu/entri/$request->idAnak")->with("sukses","Data berhasil disimpan");
    }

    public function getListPuskesmasByKabupatenId($id)
    {
        $pus = DB::table("puskesmas")
            ->where("id_kabupaten",$id)->pluck('id_puskesmas','nama_puskesmas');

        return response()->json($pus);
    }
}
