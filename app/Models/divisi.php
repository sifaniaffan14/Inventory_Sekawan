<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class divisi extends Model
{
    use HasFactory;
    protected $table        = 'divisis';

    protected $fillable = [
        'id',
        'nama_divisi',
        'is_active',
    ];
}
