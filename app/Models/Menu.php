<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    protected $table = 'Menu';
    
    protected $primaryKey = 'IdMenu';
    
    const CREATED_AT = 'WaktuBuat';
    
    const UPDATED_AT = 'WaktuUbahAkhir';

    protected $fillable = [
        'Judul',
        'RouteName',
        'RouteParams',
        'Urutan',
        'IsAktif',
        'Icon',
        'IdKategoriMenu',
        'IdMenuParent',
    ];

    public function casts(): array
    {
        return [
            'IsAktif' => 'boolean',
            'RouteParams' => 'array',
        ];
    }

    // Relationship

    public function KategoriMenu(): BelongsTo
    {
        return $this->belongsTo(KategoriMenu::class, 'IdKategoriMenu', 'IdKategoriMenu');
    }

    public function Parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'IdMenuParent', 'IdMenu');
    }

    public function Child(): HasMany
    {
        return $this->hasMany(Menu::class, 'IdMenuParent', 'IdMenu');
    }

    public function RolePrivilege(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'RolePrivilege', 'IdMenu', 'IdRole')->withPivot('Level')->withTimestamps();
    }
}
