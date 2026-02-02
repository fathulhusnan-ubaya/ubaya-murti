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

        $menu->Child()->create([
            'Judul' => 'Menu',
            'RouteName' => 'admin.menu.index',
            'Urutan' => 1,
            'IsAktif' => true,
        ]);

        $menu->Child()->create([
            'Judul' => 'Role',
            'RouteName' => 'admin.role.index',
            'Urutan' => 2,
            'IsAktif' => true,
        ]);

        $menu->Child()->create([
            'Judul' => 'Privilege',
            'RouteName' => 'admin.privilege.index',
            'Urutan' => 3,
            'IsAktif' => true,
        ]);

        $menu->Child()->create([
            'Judul' => 'User',
            'RouteName' => 'admin.user.index',
            'Urutan' => 4,
            'IsAktif' => true,
        ]);

        $role = Role::create([
            'Nama' => 'Administrator',
        ]);

        DB::table('UserRole')->insert([
            'IdUser' => 1,
            'IdRole' => $role->IdRole,
        ]);
    }
}
