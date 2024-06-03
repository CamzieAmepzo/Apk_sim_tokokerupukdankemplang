<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class harga_kerupuk extends Model
{
    use HasFactory;

    protected $table = 'harga_kerupuk';

    protected $primaryKey = 'id_harga_kerupuk';

    protected $fillable = ['id_barang', 'nominal', 'status', 'tanggal', 'waktu'];

    public $timestamps = false;
}
