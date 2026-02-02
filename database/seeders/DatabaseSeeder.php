<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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

        $menu->Privilege()->syncWithPivotValues($role->IdRole, ['Level' => 90]);
        $childMenu->Privilege()->syncWithPivotValues($role->IdRole, ['Level' => 90]);

        DB::table('UserRole')->insert([
            'IdUser' => 1,
            'IdRole' => $role->IdRole,
        ]);
    }
}
