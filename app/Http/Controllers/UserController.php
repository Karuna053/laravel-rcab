<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index(){
        $user = User::find(1);
        $user->assignRole('writer');

        dd(
            "Number of users: " . User::count(),
            "Number of writer users: " . User::role('writer')->count(),
            "Number of non-writer users: " . User::withoutRole('writer')->count(),
            "User list below:",
            User::get()
        );
    }
}
