<?php

namespace App\Http\Controllers;

use App\Exports\AnakExport;
use App\Exports\AntigenExport;
use App\Exports\IndividuExport;
use App\Models\Individu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function updateData(Request $request) {
        @dd($request->file('excelFile'));
        if (!Storage::disk('public')->exists('data')) {
            Storage::disk('public')->makeDirectory('data');
        }

        $fileExcel = $request->file('excelFile');

        $filename = Carbon::now()->format('Ymd His') . '.' . $request->file('excelFile')->extension();
        @dd(Storage::disk('public')->put('data/' . $filename, $fileExcel));
    }
}
