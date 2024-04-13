<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Array of role names
        $roles = [ 'owner', 'admin', 'client', 'hrd', 'karyawan', 'manajer'];

        // Iterate through each role name
        foreach ($roles as $roleName) {
            // Check if role exists
            $role = Role::where('role_name', $roleName)->first();

            // If role does not exist, then create it
            if (!$role) {
                Role::create([
                    'role_name' => $roleName,
                ]);
            }
        }
    }
}
