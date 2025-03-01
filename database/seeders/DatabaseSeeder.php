<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Define
        $roles = ['SuperAdmin', 'Admin', 'Rider'];

        // Create roles 
        foreach ($roles as $roleName) {
            Role::create(['role_name' => $roleName]);
        }

        Branch::create([
            'branch_name' => 'Main Branch',
            'branch_address' => 'Angeles City, Pampanga'
        ]);

        // Create admin user
        User::create([
            'role_id' => Role::where('role_name', 'SuperAdmin')->first()->id,  // Get Admin role ID dynamically
            'name' => 'SuperAdmin',
            'username' => 'SuperAdmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('superadmin'),
            'branch_id' => Branch::where('branch_name', 'Main Branch')->first()->id,  // Get Admin department ID dynamically
        ]);

        // Create admin user
        User::create([
            'role_id' => Role::where('role_name', 'Admin')->first()->id,  // Get Admin role ID dynamically
            'name' => 'Admin',
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminadmin'),
            'branch_id' => Branch::where('branch_name', 'Main Branch')->first()->id,  // Get Admin department ID dynamically
        ]);

        // Create admin user
        User::create([
            'role_id' => Role::where('role_name', 'Rider')->first()->id,  // Get Admin role ID dynamically
            'name' => 'Rider',
            'username' => 'Rider',
            'email' => 'rider@gmail.com',
            'password' => Hash::make('riderrider'),
            'branch_id' => Branch::where('branch_name', 'Main Branch')->first()->id,  // Get Admin department ID dynamically
        ]);
    }
}
