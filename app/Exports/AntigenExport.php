<?php

namespace App\Exports;

use App\Models\Antigen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AntigenExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Antigen::all();
    }

    public function headings(): array
    {
        return [
            'id_antigen',
            'nama_antigen',
            'waktu_pemberian',
            'interval_pemberian',
            'target_tahunan'
        ];
    }
}
