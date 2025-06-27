<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarPoli extends Model
{
    protected $fillable = ['id_pasien', 'id_jadwal', 'keluhan', 'no_antrian'];

    public function pasien()
    {
        return $this->belongsTo(User::class, 'id_pasien');
    }

    // Untuk fitur pasien
    public function jadwal()
    {
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal');
    }

    // Untuk fitur dokter
    public function jadwalPeriksa()
    {
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal');
    }

    public function periksa()
    {
        return $this->hasOne(Periksa::class, 'id_daftar_poli');
    }
}
