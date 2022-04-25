<?php

namespace App\Exports;

use App\Penyucian;
use Maatwebsite\Excel\Concerns\FromCollection;

class PendapatanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Penyucian::all();
    }
}
