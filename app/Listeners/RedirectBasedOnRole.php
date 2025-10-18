<?php

namespace App\Listeners;

use Filament\Events\Auth\Registered;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RedirectBasedOnRole
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        // ▼▼▼ TAMBAHKAN BARIS INI ▼▼▼
        Authenticated::class => [
            RedirectBasedOnRole::class,
        ],
    ];
    
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Authenticated $event): void
    {
        // $user = $event->user;
        // $redirectUrl = '';

        // // Aturan #1: Jika user adalah Super Admin (role_id = 1), siapkan tujuan ke /admin
        // // if ($user->role_id == 1) {
        // //     $redirectUrl = '/admin';
        // // }
        // // // Aturan #2 & #3: Untuk semua role lain, siapkan tujuan ke /dashboard
        // // else {
        // //     $redirectUrl = '/dashboard';
        // // }

        // // // Simpan tujuan ke dalam session. Fortify/Laravel akan otomatis
        // // // menggunakan URL ini untuk mengarahkan user.
        // // session(['url.intended' => $redirectUrl]);
    }
}
