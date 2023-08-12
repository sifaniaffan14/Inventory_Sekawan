<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kendaraan extends Model
{
    protected $table        = 'kendaraans';

    protected $fillable = [
        'id',
        'kode_kendaraan',
        'nama_kendaraan', 
        'merk', 
        'tahun', 
        'kondisi', 
        'status', 
        'is_active',
    ];
}
