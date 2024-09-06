<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    // Quick and dirty way to set up user, roles and permission.
    // DO NOT DO THIS IN ACTUAL LIVE CODE! DO THESE IN SEEDERS!
    public function __construct() {
        $user = User::create([
            'name' => 'Little Lives',
            'email' => 'littlelives@lamb.com',
            'password' => bcrypt('secret'),
        ]);

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

    public function index(){
        $user = User::get(1);

        dd($user);
    }
}
