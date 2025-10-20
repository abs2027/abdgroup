<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan Baru</title>
    @livewireStyles
</head>
<body>
    <div style="width: 80%; margin: 2rem auto;">
        <h1>Formulir Pendaftaran Karyawan Baru</h1>
        <p>Silakan isi data di bawah ini dengan lengkap dan benar.</p>
        <hr style="margin-bottom: 2rem;">

        {{-- Ini adalah cara memanggil komponen Livewire --}}
        @livewire('karyawan-form')

    </div>
    @livewireScripts
</body>
</html>