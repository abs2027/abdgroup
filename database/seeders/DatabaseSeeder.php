<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan RoleSeeder terlebih dahulu untuk memastikan roles ada
        $this->call([
            RoleSeeder::class,
            LokasiPenempatanSeeder::class,
            JabatanPosisiSeeder::class,
        ]);

        // Hanya jalankan seeder ini jika lingkungan BUKAN 'production'
        if (app()->environment() !== 'production') {

            // Ganti nama, email, dan password sesuai keinginan Anda
            User::updateOrCreate(
                ['email' => 'superadmin@abd.co.id'], // Kunci untuk mencari user
                [
                    'name' => 'Super Admin Fajar',
                    'password' => Hash::make('PasswordSuperAman123'),
                    'email_verified_at' => now(),
                    'role_id' => 3 // Pastikan id 3 adalah untuk 'superadmin'
                ]
            );
        }
    }
}
