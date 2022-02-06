<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function getListPuskesmasByKabupatenId($id)
    {
        $pus = DB::table("puskesmas")
            ->where("id_kabupaten",$id)->pluck('id_puskesmas','nama_puskesmas');

        return response()->json($pus);
    }

    public function getListKabupaten()
    {
        $kab = DB::table("kabupaten")
            ->pluck('id_kabupaten','nama_kabupaten');

        return response()->json($kab);
    }

    public function getListKampungByPuskesmasId($id)
    {
        $kam = DB::table("kampung")
            ->where("id_puskesmas",$id)->pluck('id_kampung','nama_kampung');

        return response()->json($kam);
    }

    public function getListPuskesmasAll() {
        $pus = DB::table("puskesmas")
            ->pluck('id_puskesmas','nama_puskesmas');

        return response()->json($pus);
    }
}
