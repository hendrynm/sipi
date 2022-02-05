<?php

namespace App\Exports;

use App\Models\Posyandu;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class PosyanduExport implements FromCollection, WithHeadings, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $id_pus = session()->get("id_puskesmas");;

        return Posyandu::select('id_posyandu', 'nama_posyandu')
            ->join("kampung","posyandu.id_kampung","=","kampung.id_kampung")
            ->where("kampung.id_puskesmas","=",$id_pus)->get();
    }

    public function headings(): array
    {
        return [
            'id_posyandu',
            'nama_posyandu',
        ];
    }

    public function title(): string
    {
        return 'Posyandu';
    }
}
