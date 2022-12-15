<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;
use DB;

class AuthDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // delete semua data user, role, permission
        DB::table('users')->delete();
        DB::table('roles')->delete();
        DB::table('permissions')->delete();
        DB::table('model_has_permissions')->delete();
        DB::table('model_has_roles')->delete();
        DB::table('role_has_permissions')->delete();

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'master-karyawan', 'guard_name' => 'web' ]);
        Permission::create(['name' => 'master-departmen', 'guard_name' => 'web' ]);
        Permission::create(['name' => 'master-bagian', 'guard_name' => 'web' ]);
        Permission::create(['name' => 'master-jabatan', 'guard_name' => 'web' ]);
        Permission::create(['name' => 'master-penempatan', 'guard_name' => 'web' ]);

        $karyawan = Role::create(['id' => 5, 'name' => 'Karyawan', 'guard_name' => 'web']);
        $admin = Role::create(['id' => 3, 'name' => 'Administrator', 'guard_name' => 'web']);
        $direktur = Role::create(['id' => 2, 'name' => 'Direktur', 'guard_name' => 'web']);
        $keuangan = Role::create(['id' => 1, 'name' => 'Keuangan', 'guard_name' => 'web']);
        $dev = Role::create(['id' => 4, 'name' => 'Developer', 'guard_name' => 'web']);
        $dev->givePermissionTo(Permission::all());

        $user = User::factory()->create([
            'name' => 'Developer',
            'email' => 'dev@dev.com',
            'password' => Hash::make('dev')
        ]);
        $user->assignRole($dev);

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin')
        ]);
        $user->assignRole($admin);

        $user = User::factory()->create([
            'name' => 'Direktur',
            'email' => 'direktur@direktur.com',
            'password' => Hash::make('direktur')
        ]);
        $user->assignRole($direktur);

        $user = User::factory()->create([
            'name' => 'Keuangan',
            'email' => 'keuangan@keuangan.com',
            'password' => Hash::make('keuangan')
        ]);
        $user->assignRole($keuangan);
    }
}
