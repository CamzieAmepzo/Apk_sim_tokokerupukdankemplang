<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'Barang';

    protected $primaryKey = 'id_barang';

    protected $fillable = ['jenisbarang', 'nama_jenisbarang'];

    public $timestamps = false;
}
