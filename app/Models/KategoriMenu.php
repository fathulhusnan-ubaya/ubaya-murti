<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriMenu extends Model
{
    protected $table = 'KategoriMenu';
    
    protected $primaryKey = 'IdKategoriMenu';
    
    const CREATED_AT = 'WaktuBuat';
    
    const UPDATED_AT = 'WaktuUbahAkhir';

    protected $fillable = [
        'Nama',
    ];

    // Relationship

    public function Menu(): HasMany
    {
        return $this->hasMany(Menu::class, 'IdKategoriMenu', 'IdKategoriMenu');
    }
}
