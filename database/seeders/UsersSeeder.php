<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Mendapatkan ID role admin dan owner
        $adminRoleId = Role::where('role_name', 'admin')->value('id');
        $ownerRoleId = Role::where('role_name', 'owner')->value('id');
        $hrdRoleId = Role::where('role_name', 'hrd')->value('id');
        $karyawanRoleId = Role::where('role_name', 'karyawan')->value('id');
        $manajerRoleId = Role::where('role_name', 'manajer')->value('id');
        $clientmitraRoleId = Role::where('role_name', 'client')->value('id');

        // Buat user dengan role admin
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // ganti 'password' dengan password yang diinginkan
            'role_id' => $adminRoleId,
        ]);

        // Buat user dengan role owner
        User::factory()->create([
            'name' => 'Owner',
            'email' => 'owner@example.com',
            'password' => Hash::make('password'), // ganti 'password' dengan password yang diinginkan
            'role_id' => $ownerRoleId,
        ]);

        User::factory()->create([
            'name' => 'Hrd',
            'email' => 'hrd@example.com',
            'password' => Hash::make('password'), // ganti 'password' dengan password yang diinginkan
            'role_id' => $hrdRoleId,
        ]);

        User::factory()->create([
            'name' => 'Karyawan',
            'email' => 'karyawan@example.com',
            'password' => Hash::make('password'), // ganti 'password' dengan password yang diinginkan
            'role_id' => $karyawanRoleId,
        ]);

        User::factory()->create([
            'name' => 'Manajer',
            'email' => 'manajer@example.com',
            'password' => Hash::make('password'), // ganti 'password' dengan password yang diinginkan
            'role_id' => $manajerRoleId,
        ]);

        // User::factory()->create([
        //     'name' => 'Client',
        //     'email' => 'client@example.com',
        //     'password' => Hash::make('password'), // ganti 'password' dengan password yang diinginkan
        //     'role_id' => $clientmitraRoleId,
        // ]);
    }
}
