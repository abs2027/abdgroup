<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-super-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        if (\App\Models\User::where('email', $email)->exists()) {
            $this->error('User with this email already exists!');
            return 1;
        }

        // Simpan password acak ke dalam variabel
        $password = Str::password(12);

        \App\Models\User::create([
            'name' => 'Super Admin',
            'email' => $email,
            'password' => Hash::make($password), // Gunakan variabel password di sini
            'email_verified_at' => now(),
            'role_id' => 3, // ID untuk superadmin
        ]);

        // Tampilkan email DAN password di pesan sukses
        $this->info("Superadmin created successfully!");
        $this->info("Email: {$email}");
        $this->info("Password: {$password}"); // <-- Baris ini penting!

        return 0;
    }
}
