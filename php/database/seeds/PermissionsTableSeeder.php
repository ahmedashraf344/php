<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed the default permissions
        $permissions = Permission::defaultPermissions();

        foreach ($permissions as $perm) {
            Permission::firstOrCreate($perm);
        }

        $this->command->info('Default permissions added.');

        $superAdminRole = Role::firstOrCreate(['name' => Role::ROLE_SUPER_ADMIN]);

        $permissions = collect($permissions)->pluck('name');
        $superAdminRole->syncPermissions($permissions);

        $superAdminUser = User::first();
        if (!$superAdminUser) {
            $superAdminUser = User::create([
                'name' => 'Super admin',
                'email' => 'admin@email.com',
                'password' => 'password',
                'verification_status'=>User::VERIFICATION_STATUS_DONE
            ]);
        }

        $superAdminUser->assignRole(Role::ROLE_SUPER_ADMIN);

    }
}
