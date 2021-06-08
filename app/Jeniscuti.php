<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jeniscuti extends Model
{
    protected $table = 'jenis_cuti';
    protected $primaryKey = 'id_jeniscuti';
    public $timestamps = false;
    protected $fillable = [
        'nama_jeniscuti'
    ];

    public function Cuti()
    {
        return $this->belongsTo('App\Cuti','id_jeniscuti');
    }
}
