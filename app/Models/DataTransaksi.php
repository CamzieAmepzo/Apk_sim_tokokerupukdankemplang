<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTransaksi extends Model
{
    use HasFactory;

    protected $table = 'data_transaksi';

    protected $primaryKey = 'id_datatransaksi';

    protected $fillable = ['id_barang', 'nominal', 'keterangan', 'status', 'tanggal', 'waktu'];

    public $timestamps = false;
}
