<?php

namespace App\Exports;

use App\Models\Individu;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class IndividuExport implements FromCollection, WithHeadings, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $id_pus = session()->get("id_puskesmas");;

        return Individu::select('id_anak', 'nama_lengkap')
            ->join("posyandu","data_individu.id_posyandu","=","posyandu.id_posyandu")
            ->join("kampung","posyandu.id_kampung","=","kampung.id_kampung")
            ->where("kampung.id_puskesmas","=",$id_pus)->get();
    }

    public function headings(): array
    {
        return [
            'id_anak',
            'nama_lengkap',
        ];
    }

    public function title(): string
    {
        return 'Individu';
    }
}
