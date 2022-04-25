<?php

namespace App\Exports;

use App\JenisCuci;
use Maatwebsite\Excel\Concerns\FromCollection;

class JenisEcxel implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return JenisCuci::all();
    }
}
