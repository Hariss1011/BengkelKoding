<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $fillable = ['nama', 'alamat', 'no_hp', 'id_poli'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }
    public function jadwal()
    {
        return $this->hasMany(JadwalPeriksa::class, 'id_dokter');
    }
}
