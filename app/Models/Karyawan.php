<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // PASTIKAN BAGIAN INI ADA DI DALAM MODEL ANDA
    protected $fillable = [
        'nomer_induk_karyawan',
        'nama_panjang',
        'nik_ktp',
        'alamat_domisili',
        'lokasi_penempatan_id',
        'jabatan_posisi_id',
        'nomer_hp',
        'tanggal_masuk',
        'status_karyawan',
        'nama_kontak_darurat',
        'hp_kontak_darurat',
    ];

    /**
     * Mendapatkan jabatan posisi untuk karyawan.
     */
    public function jabatanPosisi()
    {
        return $this->belongsTo(JabatanPosisi::class);
    }
}