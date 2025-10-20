<?php

namespace App\Http\Controllers;

use App\Models\AssetCategory;
use Illuminate\Http\Request;

class AssetCategoryController extends Controller
{
   /**
     * Tampilkan daftar semua jenis aset.
     */
    public function index()
    {
        // 1. Ambil semua data dari database
        $categories = AssetCategory::all(); 
        
        // 2. Kirim data ke view yang sudah Anda buat
        return view('asset_categories.index', compact('categories')); 
    }

    /**
     * Tampilkan form untuk membuat jenis aset baru.
     */
    public function create()
    {
        // 1. Tampilkan view 'create.blade.php'
        return view('asset_categories.create'); 
    }

    /**
     * [INI BAGIAN BARUNYA]
     * Simpan jenis aset baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk dari form
        $request->validate([
            'name' => 'required|string|unique:asset_categories|max:255',
        ]);

        // 2. Simpan ke database
        AssetCategory::create([
            'name' => $request->name,
        ]);

        // 3. Arahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('asset_categories.index')->with('success', 'Jenis Aset berhasil ditambahkan.');
    }
}
