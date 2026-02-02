<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $connection = 'murti';
    
    
    protected $table = 'user';

    protected $primaryKey = 'id';

    protected $fillable = [];

    protected $hidden = [
        'password',
    ];

    // Relationship

    public function Role(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'UserRole', 'IdUser', 'IdRole');
    }

    // Non-static Functions

    public function retrieveSession(): void
    {
        // Role

        $role = $this->Role->first();
        abort_if(! $role, 403, 'Anda belum diberikan akses apapun!');
        $my['RoleAktif'] = $role;
        $my['id'] = $this->id;
        $menus = $role->Menu->pluck('IdMenu');

        // Menu

        $my['Menu'] = Menu::query()
            ->whereNull('IdMenuParent')
            ->when($role->Nama != 'Administrator', fn ($query) => $query->whereIn('IdMenu', $menus))
            ->orderBy('Urutan')
            ->with(['Child' => function ($query) use ($role, $menus) {
                $query->orderBy('Urutan')
                    ->where('IsAktif', 1)
                    ->when($role->Nama != 'Administrator', fn ($query) => $query->whereIn('IdMenu', $menus))
                    ->get();
            }])->get();

        // Simpan di session

        session()->put('my', (object) $my);
    }
}
