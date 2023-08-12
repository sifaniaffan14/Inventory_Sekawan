<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemesanan extends Model
{
    use HasFactory;
    protected $table        = 'pemesanans';

    protected $fillable = [
        'id',
        'karyawan_id',
        'driver_id', 
        'karyawan_approval_id', 
        'kendaraan_id', 
        'status', 
    ];
}
