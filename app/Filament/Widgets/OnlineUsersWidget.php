<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class OnlineUsersWidget extends Widget
{
    // Tentukan file view untuk widget ini
    protected static string $view = 'filament.widgets.online-users-widget';

    // Atur agar widget refresh otomatis setiap 10 detik
    protected static ?string $pollingInterval = '10s';

    // Sembunyikan judul default widget
    protected bool $hasHeading = false;

    // Ambil data user online saat widget akan ditampilkan
    public function getViewData(): array
    {
        return [
            // Panggil fungsi yang kita buat di model User
            'onlineUsers' => User::getOnlineUsers(5), // Anggap online jika aktif 5 menit terakhir
        ];
    }

    /**
     * Kontrol siapa yang bisa melihat widget ini.
     * Hanya tampilkan jika pengguna adalah Superadmin (role_id = 3).
     */
    public static function canView(): bool
    {
        // Pastikan pengguna login dan role_id nya adalah 3 (Superadmin)
        return Auth::check() && Auth::user()->role_id === 1;
    }
}
