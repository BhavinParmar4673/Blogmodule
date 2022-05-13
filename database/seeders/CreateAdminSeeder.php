<?php

namespace Database\Seeders;

use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Seeder;

class CreateAdminSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Admin::create(['name' => 'super Admin', 'email' => 'superadmin@gmail.com', 'email_verified_at' => now()->format('Y-m-d H:i:s'), 'password' => Hash::make('12345678')]);


        $admin = Admin::create(['name' => 'admin', 'email' => 'admin@gmail.com', 'email_verified_at' => now()->format('Y-m-d H:i:s'), 'password' => Hash::make('12345678')]);
    }
}