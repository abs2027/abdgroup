<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenKaryawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'karyawan_id',
        'nama_dokumen',
        'path_file',
        'nama_asli_file',
    ];
}
