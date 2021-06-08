<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    protected $table = 'cuti';
    protected $primaryKey = 'id_cuti';
    public $timestamps = false;
    protected $fillable = [
        'id_jeniscuti','nik','mulai_cuti','akhir_cuti','jumlah_cuti','sisa_cuti','keterangan'
    ];
    
    public function Jeniscuti()
    {
        return $this->hasOne('App\Jeniscuti','id_jeniscuti');
    }

    public function Karyawan()
    {
        return $this->hasOne('App\Karyawan','nik');
    }
}
