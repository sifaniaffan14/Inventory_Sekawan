<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class karyawan extends Model
{
    use HasFactory;
    protected $table        = 'karyawans';

    protected $fillable = [
        'id',
        'nama_karyawan',
        'divisi_id', 
        'user_id',
        'jabatan', 
        'is_active',
    ];
}
