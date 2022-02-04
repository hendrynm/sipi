<?php

namespace App\Exports;

use App\Models\Individu;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IndividuExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Individu::all('id_anak', 'nama_lengkap');
    }

    public function headings(): array
    {
        return [
            'id_anak',
            'nama_lengkap',
        ];
    }
}
