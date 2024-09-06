<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserPermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create user.
        $user = User::where('name', 'Little Lives')->first();

        if (!isset($user)){
            $user = User::create([
                'name' => 'Little Lives',
                'email' => 'littlelives@lamb.com',
                'password' => bcrypt('secret'),
            ]);
        }

        // Create roles and permissions.
        $writer_role = Role::where('name', 'writer')->first();
        $create_articles_permission = Role::where('name', 'edit_articles')->first();
        $edit_articles_permission = Role::where('name', 'edit_articles')->first();
        $delete_articles_permission = Role::where('name', 'edit_articles')->first();

        if (!isset($writer_role)) {
            $writer_role = Role::create(['name' => 'writer']);
        }

        if (!isset($create_articles_permission)) {
            $create_articles_permission = Permission::create(['name' => 'create articles']);
            $create_articles_permission->assignRole($writer_role);
        }

        if (!isset($edit_articles_permission)) {
            $edit_articles_permission = Permission::create(['name' => 'edit articles']);
            $edit_articles_permission->assignRole($writer_role);
        }

        if (!isset($delete_articles_permission)) {
            $delete_articles_permission = Permission::create(['name' => 'delete articles']);
            $delete_articles_permission->assignRole($writer_role);
        }
    }
}
