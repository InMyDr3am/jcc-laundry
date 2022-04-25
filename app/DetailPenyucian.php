<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPenyucian extends Model
{
    protected $table = 'detail_penyucian';
    protected $fillable = ["penyucian_id","jenis_cuci_id","berat","total_harga"]; 
    
    
    // public function jenis_cuci()
    // {
    //     return $this->belongsTo('App\JenisCuci','jenis_cuci_id');
    // }

    public function penyucian()
    {
        return $this->belongsTo('App\Penyucian','penyucian_id');
    }

    public function jenis_cuci()
    {
        return $this->belongsTo('App\JenisCuci','jenis_cuci_id');
    }
}
