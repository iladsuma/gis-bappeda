<?php

namespace Database\Seeders\Permission;

use App\Models\Administrator\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permission
        // Dashboard Akses
        Permission::firstOrCreate(['name' => 'Dashboard']);
        //Master Data Akses
        Permission::firstOrCreate(['name' => 'Master Data.Data Opd']);
        Permission::firstOrCreate(['name' => 'Master Data.Data Kelurahan']);
        Permission::firstOrCreate(['name' => 'Master Data.Data Lokasi']);
        // Data Dokumen Akses
        Permission::firstOrCreate(['name' => 'Data Dokumen.Feasibility Study']);
        Permission::firstOrCreate(['name' => 'Data Dokumen.Master Plan']);
        Permission::firstOrCreate(['name' => 'Data Dokumen.Lingkungan']);
        Permission::firstOrCreate(['name' => 'Data Dokumen.Detail Engineering Design']);
        Permission::firstOrCreate(['name' => 'Data Dokumen.Dokumen Fisik']);
        // Data Pendukung akses
        Permission::firstOrCreate(['name' => 'Data Pendukung.Kawasan Kumuh']);
        Permission::firstOrCreate(['name' => 'Data Pendukung.Kawasan RTLH']);
        Permission::firstOrCreate(['name' => 'Data Pendukung.Lokus Kemiskinan']);
        Permission::firstOrCreate(['name' => 'Data Pendukung.Lokus Stunting']);
        Permission::firstOrCreate(['name' => 'Data Pendukung.Jaringan Spam']);
        // Administrator Akses
        Permission::firstOrCreate(['name' => 'Administrator.Hak Akses']);
        Permission::firstOrCreate(['name' => 'Administrator.Data User']);

        User::truncate();
        $superAdminRole = Role::firstOrCreate(['name' => 'Super-Admin']);
        $superAdminPermissions = [
            'Dashboard',
            'Master Data.Data Opd',
            'Master Data.Data Kelurahan',
            'Master Data.Data Lokasi',
            'Data Dokumen.Feasibility Study',
            'Data Dokumen.Master Plan',
            'Data Dokumen.Lingkungan',
            'Data Dokumen.Detail Engineering Design',
            'Data Dokumen.Dokumen Fisik',
            'Data Pendukung.Kawasan Kumuh',
            'Data Pendukung.Kawasan RTLH',
            'Data Pendukung.Lokus Kemiskinan',
            'Data Pendukung.Lokus Stunting',
            'Data Pendukung.Jaringan Spam',
            'Administrator.Hak Akses',
            'Administrator.Data User',
        ];
        $superAdminRole->syncPermissions($superAdminPermissions);

        $user = User::where('username', 'Administrator')->first();
        if (!$user) {
            $user = User::firstOrCreate([
                'name' => 'Administrator',
                'username' => 'Administrator',
                'password' => bcrypt('password'),
                'avatar' => 'avatar-default.png',
            ]);
            echo "username: Administrator\n";
            echo "password: password\n";
        }

        $user->assignRole($superAdminRole);

        $generalRole = Role::firstOrCreate(['name' => 'General']);
        $generalPermissions = [
            'Dashboard',
        ];
        $generalRole->syncPermissions($generalPermissions);
    }
}
