<?php

namespace App\Livewire; // Pastikan namespace sudah benar

use App\Models\JabatanPosisi;
use App\Models\Karyawan;
use App\Models\LokasiPenempatan;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Validation\Rule;

use Livewire\WithFileUploads;

class KaryawanEdit extends Component
{
    use WithFileUploads;

    public Karyawan $karyawan;

    // Properti yang akan dihubungkan (binding) dengan input form
    public $nomer_induk_karyawan;
    public $nama_panjang;
    public $nik_ktp;
    public $alamat_domisili;
    public $lokasi_penempatan_id;
    public $jabatan_posisi_id;
    public $nomer_hp;
    public $tanggal_masuk;
    public $status_karyawan;
    public $nama_kontak_darurat;
    public $hp_kontak_darurat;
    public $nama_dokumen_baru;
    public $file_dokumen_baru;

    protected function rules()
    {
        return [
            'nomer_induk_karyawan' => ['required', Rule::unique('karyawans')->ignore($this->karyawan->id)],
            'nama_panjang'           => 'required|string|min:3',
            'nik_ktp'                => ['required', 'digits:16', Rule::unique('karyawans')->ignore($this->karyawan->id)],
            'alamat_domisili'        => 'required|string|min:10',
            'lokasi_penempatan_id'   => 'required|exists:lokasi_penempatans,id',
            'jabatan_posisi_id'      => 'required|exists:jabatan_posisis,id',
            'nomer_hp'               => 'required|numeric',
            'tanggal_masuk'          => 'required|date',
            'status_karyawan'        => 'required',
            'nama_kontak_darurat'    => 'required|string|min:3',
            'hp_kontak_darurat'      => 'required|numeric',
        ];
    }

    public function mount(Karyawan $karyawan)
    {
        $this->karyawan = $karyawan;
        $this->nomer_induk_karyawan = $karyawan->nomer_induk_karyawan;
        $this->nama_panjang = $karyawan->nama_panjang;
        $this->nik_ktp = $karyawan->nik_ktp;
        $this->alamat_domisili = $karyawan->alamat_domisili;
        $this->lokasi_penempatan_id = $karyawan->lokasi_penempatan_id;
        $this->jabatan_posisi_id = $karyawan->jabatan_posisi_id;
        $this->nomer_hp = $karyawan->nomer_hp;
        $this->tanggal_masuk = $karyawan->tanggal_masuk;
        $this->status_karyawan = $karyawan->status_karyawan;
        $this->nama_kontak_darurat = $karyawan->nama_kontak_darurat;
        $this->hp_kontak_darurat = $karyawan->hp_kontak_darurat;
    }

    public function update()
    {
        $this->karyawan->update($this->validate());

        session()->flash('message', 'Data karyawan berhasil diperbarui.');
    }

    /**
 * Render the component.
 *
 * @return \Illuminate\Contracts\View\View
 */
    public function render()
    {
        $semua_lokasi = LokasiPenempatan::all();
        $semua_jabatan = JabatanPosisi::all();

        return view('livewire.karyawan-edit', [
            'semua_lokasi' => $semua_lokasi,
            'semua_jabatan' => $semua_jabatan,
        ])->layout('components.layouts.app'); // <-- INI YANG BENAR
    }

    public function uploadDokumen()
    {
        // 1. Validasi input
        $this->validate([
            'nama_dokumen_baru' => 'required|string|min:3',
            'file_dokumen_baru' => 'required|file|mimes:pdf,jpg,png,doc,docx|max:2048', // Maks 2MB
        ]);

        // 2. Simpan file ke folder 'dokumen-karyawan' di dalam 'storage/app/public'
        $path = $this->file_dokumen_baru->store('dokumen-karyawan', 'public');

        // 3. Simpan informasi file ke database
        $this->karyawan->dokumens()->create([
            'nama_dokumen' => $this->nama_dokumen_baru,
            'path_file' => $path,
            'nama_asli_file' => $this->file_dokumen_baru->getClientOriginalName(),
        ]);

        // 4. Reset form upload dan kirim pesan sukses
        $this->reset(['nama_dokumen_baru', 'file_dokumen_baru']);
        session()->flash('message-dokumen', 'Dokumen berhasil diunggah.');
    }

    // [BARU] Fungsi untuk menghapus dokumen
    public function deleteDokumen($dokumenId)
    {
        // 1. Temukan data dokumen di database
        $dokumen = \App\Models\DokumenKaryawan::find($dokumenId);

        if ($dokumen) {
            // 2. Hapus file fisiknya dari storage
            Storage::disk('public')->delete($dokumen->path_file);
            
            // 3. Hapus catatan datanya dari database
            $dokumen->delete();

            // 4. Kirim pesan sukses
            session()->flash('message-dokumen', 'Dokumen berhasil dihapus.');
        }
    }
}