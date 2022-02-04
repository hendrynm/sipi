<?php

namespace App\Imports;

use App\Models\Imunisasi;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class ImunisasiImport implements OnEachRow, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();

        if (!isset($row['no'])) {
            return null;
        }

        if (!isset($row['id_anak'])) {
            return null;
        }

        if (!isset($row['id_antigen'])) {
            return null;
        }

        if (!isset($row['tanggal_pemberian'])) {
            return null;
        }

        $date = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_pemberian']));
//        @dd($date);

        Imunisasi::where('id_anak', $row['id_anak'])->where('id_antigen', $row['id_antigen'])->update(['status' => 'sudah', 'tanggal_pemberian' => $date]);

    }
}
