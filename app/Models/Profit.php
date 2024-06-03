<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uang_PKL extends Model
{
    use HasFactory;

    protected $table = 'profit';

    protected $primaryKey = 'id_profit';

    protected $fillable = ['id_barang', 'nominal', 'keterangan', 'status', 'tanggal', 'waktu'];

    public $timestamps = false;
}
