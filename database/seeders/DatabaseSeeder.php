<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::create([
            'Username' => 'root',
            'Nama' => 'Administrator',
            'Email' => 'root@example.com',
            'Password' => Hash::make('password'),
        ]);

        $menu = Menu::create([
            'Judul' => 'Administrator',
            'RouteName' => 'admin.*',
            'Urutan' => 1,
            'IsAktif' => true,
            'Icon' => 'shield',
        ]);

        $childMenu = $menu->Child()->create([
            'Judul' => 'Menu',
            'RouteName' => 'admin.menu.index',
            'Urutan' => 1,
            'IsAktif' => true,
        ]);

        $role = Role::create([
            'Nama' => 'Administrator',
        ]);

        $menu->RolePrivilege()->syncWithPivotValues($role->IdRole, ['Level' => 90]);
        $childMenu->RolePrivilege()->syncWithPivotValues($role->IdRole, ['Level' => 90]);

        $user->Role()->sync($role->IdRole);
    }
}
