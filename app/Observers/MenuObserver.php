<?php

namespace App\Observers;

use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class MenuObserver
{
    /**
     * Handle the Menu "creating" event.
     *
     * @return void
     */
    public function creating(Menu $menu)
    {
        // Setting Urutan

        Menu::query()
            ->when(
                request()->has('induk'),
                fn ($query) => $query->where('IdMenuParent', request()->induk),
                fn ($query) => $query->whereNull('IdMenuParent')
            )
            ->where('Urutan', '>=', request()->urutan)
            ->update(['Urutan' => DB::raw('Urutan + 1')]);
    }

    /**
     * Handle the Menu "updating" event.
     *
     * @return void
     */
    public function updating(Menu $menu)
    {
        // Setting Urutan

        $menu = (object) $menu->getOriginal();

        Menu::withoutEvents(function () use ($menu) {
            if ($menu->IdMenuParent != request()->induk) {
                Menu::query()
                    ->when(
                        ! empty($menu->IdMenuParent),
                        fn ($query) => $query->where('IdMenuParent', $menu->IdMenuParent),
                        fn ($query) => $query->whereNull('IdMenuParent')
                    )
                    ->get()
                    ->map(function ($menu, $key) {
                        $menu->update(['Urutan' => ($key + 1)]);
                    });

                Menu::query()
                    ->when(
                        request()->has('induk'),
                        fn ($query) => $query->where('IdMenuParent', request()->induk),
                        fn ($query) => $query->whereNull('IdMenuParent')
                    )
                    ->where('Urutan', '>=', request()->urutan)
                    ->update(['Urutan' => DB::raw('Urutan + 1')]);
            } elseif (request()->urutan > $menu->Urutan) {
                Menu::query()
                    ->when(
                        request()->has('induk'),
                        fn ($query) => $query->where('IdMenuParent', request()->induk),
                        fn ($query) => $query->whereNull('IdMenuParent')
                    )
                    ->where('Urutan', '<=', request()->urutan)
                    ->where('Urutan', '>=', $menu->Urutan)
                    ->whereNot('IdMenu', $menu->IdMenu)
                    ->update(['Urutan' => DB::raw('Urutan - 1')]);
            } elseif (request()->urutan < $menu->Urutan) {
                Menu::query()
                    ->when(
                        request()->has('induk'),
                        fn ($query) => $query->where('IdMenuParent', request()->induk),
                        fn ($query) => $query->whereNull('IdMenuParent')
                    )
                    ->where('Urutan', '>=', request()->urutan)
                    ->where('Urutan', '<=', $menu->Urutan)
                    ->whereNot('IdMenu', $menu->IdMenu)
                    ->update(['Urutan' => DB::raw('Urutan + 1')]);
            }
        });

    }

    /**
     * Handle the Menu "deleting" event.
     *
     * @return void
     */
    public function deleting(Menu $menu)
    {
        // Setting Urutan
        Menu::withoutEvents(function () use ($menu) {
            Menu::query()
                ->when(
                    ! empty($menu->IdMenuParent),
                    fn ($query) => $query->where('IdMenuParent', $menu->IdMenuParent),
                    fn ($query) => $query->whereNull('IdMenuParent')
                )
                ->where('Urutan', '>=', $menu->Urutan)
                ->whereNot('IdMenu', $menu->IdMenu)
                ->update(['Urutan' => DB::raw('Urutan - 1')]);
        });
    }
}
