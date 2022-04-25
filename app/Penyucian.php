<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penyucian extends Model
{

    protected $table = 'penyucian';
    protected $fillable = ["user_id","nama_pemesan","no_hp","tgl_masuk","tgl_keluar","total_bayar","keterangan"]; 
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function detail_penyucian()
    {
        return $this->hasMany('App\DetailPenyucian');
    }
    
    public function hitung($tgl_masuk){
        $this->db->select_sum('total_bayar');
        $this->db->where('tgl_masuk',$tgl_masuk);
        $query = $this->db->get('penyucian');
        return $query->result();
      }
}
