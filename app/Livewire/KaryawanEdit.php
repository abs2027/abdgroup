<?php

namespace App\Livewire; // Pastikan namespace sudah benar

use App\Models\JabatanPosisi;
use App\Models\Karyawan;
use App\Models\LokasiPenempatan;
use Livewire\Component;
use Illuminate\Validation\Rule;

class KaryawanEdit extends Component
{
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
}