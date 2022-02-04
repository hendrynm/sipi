<?php

namespace App\Exports;

use App\Models\Individu;
use Maatwebsite\Excel\Concerns\FromCollection;

class AnakExport implements FromCollection
{
    public function collection()
    {
        Individu::all();
    }
}
