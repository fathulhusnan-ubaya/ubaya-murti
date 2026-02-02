<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $connection = 'local';

    protected $table = 'Role';

    protected $primaryKey = 'IdRole';

    const CREATED_AT = 'WaktuBuat';

    const UPDATED_AT = 'WaktuUbahAkhir';

    protected $fillable = [
        'Nama',
    ];

    // Relationship

    public function User(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'UserRole', 'IdRole', 'IdUser');
    }

    public function Menu(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class, 'Privilege', 'IdRole', 'IdMenu')->withPivot('Level')->withTimestamps();
    }

    // Non-static Functions

    public function getLevelPermission(string $routeName): int
    {
        if (auth()->user()->Role()->where('Nama', 'Administrator')->first()) { // Administrator
            return 90;
        } else {
            return $this->Menu()->where('RouteName', $routeName)->where('IsAktif', true)->first()?->pivot?->Level ?? 0;
        }
    }
}
