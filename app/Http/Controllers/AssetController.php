<?php

namespace App\Http\Controllers;

use App\Models\Asset; // <-- IMPORT INI
use App\Models\AssetCategory; // <-- IMPORT INI JUGA
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Tampilkan halaman daftar aset.
     */
    public function index()
    {
        // Ambil semua aset, beserta data 'category'-nya
        $assets = Asset::with('category')->get();
        
        // Kirim data ke view 'assets.index'
        return view('assets.index', compact('assets'));
    }

    /**
     * Tampilkan form untuk menambah aset baru.
     */
    public function create()
    {
        // Ambil semua KATEGORI untuk ditampilkan di dropdown
        $categories = AssetCategory::all();

        // Kirim data kategori ke view 'assets.create'
        return view('assets.create', compact('categories'));
    }

    /**
     * Simpan aset baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi data umum
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'asset_category_id' => 'required|exists:asset_categories,id',
            'specifications' => 'nullable|array' // 'specifications' harus berupa array
        ]);

        // Langsung simpan.
        // Laravel akan otomatis mengubah array 'specifications'
        // menjadi JSON karena kita sudah setting $casts di Model.
        Asset::create($validatedData);

        return redirect()->route('assets.index')->with('success', 'Aset baru berhasil ditambahkan.');
    }
}