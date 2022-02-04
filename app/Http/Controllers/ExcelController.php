<?php

namespace App\Http\Controllers;

use App\Exports\AnakExport;
use App\Exports\AntigenExport;
use App\Exports\IndividuExport;
use App\Models\Individu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function unduhFormat()
    {
        return Storage::download('contoh_excel/input_data.xlsx');
    }

    public function unduhDataAnak() {
        return Excel::download(new IndividuExport(), 'anak.xlsx');
    }

    public function unduhDataAntigen() {
        return Excel::download(new AntigenExport(), 'antigen.xlsx');
    }
}
