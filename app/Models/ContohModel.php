<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContohModel extends Model
{
    protected $connection = 'local';
    
    protected $table = 'Contoh';

    protected $primaryKey = 'IdContoh';

    protected $fillable = [
        'Nama',
    ];
}
