<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BahanMakanan extends Model
{
    use HasFactory;

    protected $table = 'bahan_makanans';

    protected $fillable = [
        'nama',
        'satuan',
        'stok',
        'deskripsi',
    ];

    protected $casts = [
        'stok' => 'integer'
    ];
}
