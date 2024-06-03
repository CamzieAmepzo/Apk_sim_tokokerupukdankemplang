<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Draf extends Model
{
    use HasFactory;

    protected $table = 'draf_pendaftaran';

    protected $primaryKey = 'id_draf';

    protected $fillable = ['id_kategori', 'nama_barang', 'alamat_barang', 'status', 'jenisbarang', 'bayar', 'tanggal'];
    public $timestamps = false;
}
