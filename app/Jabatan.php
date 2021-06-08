<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatan';
    protected $primaryKey = 'id_jabatan';
    public $timestamps = false;
    protected $fillable = [
        'nama_jabatan'
    ];

    public function Karyawan()
    {
        return $this->belongsTo('App\Karyawan','id_jabatan');
    }
}
