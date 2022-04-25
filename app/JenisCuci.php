<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisCuci extends Model
{
    protected $table = 'jenis_cuci';

    public function detail_penyucian()
    {
        return $this->hasMany('App\DetailPenyucian');
    }
    
   
}
