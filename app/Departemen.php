<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    protected $table = 'departemen';
    protected $primaryKey = 'id_departemen';
    public $timestamps = false;
    protected $fillable = [
        'nama_departemen'
    ];

    public function Karyawan()
    {
        return $this->belongsTo('App\Karyawan','id_departemen');
    }

}
