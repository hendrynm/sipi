<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AnakAntigenPosyanduExport implements WithMultipleSheets
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function sheets(): array
    {
        $sheets = [];
        $sheets[] = new AntigenExport();
        $sheets[] = new IndividuExport();
        $sheets[] = new PosyanduExport();
        return $sheets;
    }
}
