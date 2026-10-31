<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrNew(['email' => 'admin@sts.com.sa']);
        $admin->name = 'STS Administrator';
        $admin->phone = '+966 50 676 1942';
        $admin->password = Hash::make('Admin@STS2026');
        $admin->is_admin = true;
        $admin->role = 'admin';
        $admin->email_verified_at = now();
        $admin->save();
    }
}
