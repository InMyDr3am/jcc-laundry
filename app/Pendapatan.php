<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendapatan extends Model
{
    public function rupiah($angka){
	
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;
     
    }
}
