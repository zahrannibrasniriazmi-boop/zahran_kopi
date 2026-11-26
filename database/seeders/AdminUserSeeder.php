<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Membuat akun administrator default untuk dashboard Zahran Kopi.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@zahrankopi.id'],
            [
                'name' => 'Admin Zahran Kopi',
                'password' => Hash::make('AdminZahranKopi123!'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}
