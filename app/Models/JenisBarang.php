<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    use HasFactory;
    protected $table = 'jenisbarang';

    protected $primaryKey = 'id_jenisbarang';

    protected $fillable = ['jenisbarang', 'nama_jenisbarang'];

    public $timestamps = false;
}
