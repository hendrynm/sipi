<?php

namespace App\Http\Controllers;

use App\Exports\AnakAntigenPosyanduExport;
use App\Exports\AnakExport;
use App\Exports\AntigenExport;
use App\Exports\IndividuExport;
use App\Imports\ImunisasiImport;
use App\Models\Imunisasi;
use App\Models\Individu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
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
        $request->validate([
            'excelFile' => 'required|mimes:xlsx,xls'
        ]);
        if (!Storage::disk('public')->exists('data')) {
            Storage::disk('public')->makeDirectory('data');
        }

        $fileExcel = $request->file('excelFile');

//        $filename = Carbon::now()->format('YmdHis') . '.' . $request->file('excelFile')->extension();
        $path = Storage::disk('public')->put('data/', $fileExcel);

        $file = Storage::disk('public')->path($path);

        Excel::import(new ImunisasiImport(), $file);

        $request->session()->flash("sukses","Data berhasil diupdate");

        return redirect(route('puskesmas.posyandu.dashboard'))->with(['sukses', 'Data berhasil diupdate']);
    }

    public function unduhDataAll() {
        return Excel::download(new AnakAntigenPosyanduExport(), 'data.xlsx');
    }
}
