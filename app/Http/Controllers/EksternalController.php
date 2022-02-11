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

    public function id_user()
    {
        return session()->get("id_user");
    }

    public function cekStatus($id)
    {
        $kueri1 = (new EksternalModel)->cekIDL($id);
        if($kueri1 > 0)
        {
            (new EksternalModel)->ubahIDL($id);
        }

        $kueri2 = (new EksternalModel)->cekIRL($id);
        if($kueri2 > 0)
        {
            (new EksternalModel)->ubahIRL($id);
        }

        $kueri3 = (new EksternalModel)->cekT($id);
        if($kueri3 > 0)
        {
            (new EksternalModel)->ubahT($id, $kueri3);
        }
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
        $kueri = (new EksternalModel)->dataTambahKirim($request);
        if($kueri > 0)
        {
            return redirect("/eksternal/data-anak/detail/$kueri")
                ->with("sukses","Data berhasil disimpan");
        }
        if($kueri === 0)
        {
            return redirect("/eksternal/data-anak/tambah")
                ->with("gagal","Data gagal disimpan, mohon pperiksa kembali");
        }
        return redirect("/eksternal/data-anak/tambah")
            ->with("gagal","Data gagal disimpan, mohon pperiksa kembali");
    }

    public function posDashboard()
    {
        return view("eksternal.posyandu.dashboard");
    }

    public function posMulai(Request $request)
    {
        $kueri = (new EksternalModel)->posMulai($request);
        if(count($kueri) > 0)
        {
            return view("eksternal.posyandu.mulaiPosyandu",["data"=>$kueri])
                ->with("sukses","Data berhasil disimpan");
        }
        return redirect("/eksternal/posyandu/dashboard")->with("gagal","Data Anak tidak ditemukan");
    }

    public function posEntri($id)
    {
        $kueri = (new EksternalModel)->dataDetail($id);
        $kueri2 = (new EksternalModel)->dataDetailImunisasi($id);
        $kueri3 = (new EksternalModel)->posEntri($id);
        $kueri4 = (new EksternalModel)->posEntriLokasi($this->id_user());
        return view("eksternal.posyandu.entriPosyandu",["data"=>$kueri,"data2"=>$kueri2,"data3"=>$kueri3,"data4"=>$kueri4]);
    }

    public function posEntriKirim(Request $request)
    {
        (new EksternalModel)->posEntriKirim($request);
        $this->cekStatus($request->idAnak);
        return redirect("/eksternal/posyandu/entri/$request->idAnak")->with("sukses","Data berhasil disimpan");
    }
}
