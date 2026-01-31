<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;

class Select2Controller extends Controller
{
    public function role(Request $request)
    {
        $roles = Role::where('Nama', 'like', "%{$request->search}%")->pluck('Nama', 'IdRole');

        return $roles->map(fn ($role, $id) => [
            'id' => $id,
            'text' => $role,
        ])->values();
    }

    public function menu(Request $request)
    {
        $menus = Menu::where('Judul', 'like', "%{$request->search}%")->pluck('Judul', 'IdMenu');

        return $menus->map(fn ($menu, $id) => [
            'id' => $id,
            'text' => $menu,
        ])->values();
    }
}
