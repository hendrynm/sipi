<?php

namespace App\Imports;

use App\Models\Imunisasi;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToModel;

class ImunisasiImport implements OnEachRow
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

        @dd($row);

        if (!isset($row[0])) {
            return null;
        }

        if (!isset($row[1])) {
            return null;
        }

        if (!isset($row[2])) {
            return null;
        }

        Imunisasi::where('id_anak', $row[1])->where('id_antigen', $row[2])->update(['status' => 'sudah', 'tanggal_pemberian' => $row[3]], 'tempat_imunisasi' => $row[4]);


    }
}
