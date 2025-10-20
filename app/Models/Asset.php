<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    // Izinkan semua field diisi (atau ganti jadi $fillable)
    protected $guarded = [];

    // KUNCI: Otomatis ubah JSON jadi array saat dibaca
    protected $casts = [
        'specifications' => 'array',
    ];

    // Definisikan relasi ke Jenis Aset
    public function category()
    {
        return $this->belongsTo(AssetCategory::class, 'asset_category_id');
    }
}
