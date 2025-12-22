<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin already exists
        $existingAdmin = User::where('email', 'admin@gmail.com')->first();

        if (!$existingAdmin) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
            ]);

            $this->command->info('✅ Đã tạo tài khoản Admin (admin@gmail.com / 12345678)');
        } else {
            $this->command->info('ℹ️ Tài khoản admin đã tồn tại.');
        }
    }
}
