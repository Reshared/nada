<?php

namespace App\Http\Controllers;

use App\Menu;

class UserController extends Controller
{
    public function user()
    {
        return $this->auth();
    }

    public function roles()
    {
        return $this->auth()->roles->each(function($role) {
            $role->load('permissions');
        });
    }

    public function menus()
    {
        $paths = [];

        foreach ($this->roles() as $role) {
            $paths = array_merge($paths, $role->permissions->pluck('path')->toArray());
        }

        return Menu::whereIn('path', $paths)->orderBy('sort')->get();
    }
}
