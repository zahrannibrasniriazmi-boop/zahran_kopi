<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Membuat akun administrator default untuk dashboard @difMarket.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@difmarket.id'],
            [
                'name' => 'Admin @difMarket',
                'password' => Hash::make('AdminDifMarket123!'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}
