<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawan';
    protected $primaryKey = 'nik';
    public $timestamps = false;
    protected $fillable = [
        'id_departemen','id_jabatan','nama','tempat_lahir','jk','telp','alamat','status_pegawai','pendidikan'
    ];

    public function Departemen()
    {
        return $this->hasOne('App\Departemen','id_departemen');
    }
    public function Jabatan()
    {
        return $this->hasOne('App\Jabatan','id_jabatan');
    }
}
