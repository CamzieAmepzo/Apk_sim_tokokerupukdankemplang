<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class harga_kemplang extends Model
{
    use HasFactory;

    protected $table = 'harga_kemplang';

    protected $primaryKey = 'id_harga_kemplang';

    protected $fillable = ['id_barang', 'bulan', 'nominal', 'tanggal', 'waktu'];

    public $timestamps = false;
}
