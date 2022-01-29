<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CapaianController extends Controller
{
    public function capaianKabupaten()
    {
        return view("provinsi.capaian.capaianKabupaten");
    }

    public function capaianKampung()
    {
        return view("provinsi.capaian.capaianKampung");
    }

    public function capaianProvinsi()
    {
        return view("provinsi.capaian.capaianProvinsi");
    }

    public function capaianPuskesmas()
    {
        return view("provinsi.capaian.capaianPuskesmas");
    }

    private function getAntigen() {
        return ['1', '2', '3'];
    }

    private function getIDL() {
        return ['1', '2', '3'];
    }

    private function getIRL() {
        return ['1', '2', '3'];
    }

    private function getKetercapaian() {
        return ['1', '2', '3'];
    }

    private function getT() {
        return ['1', '2', '3'];
    }
}
