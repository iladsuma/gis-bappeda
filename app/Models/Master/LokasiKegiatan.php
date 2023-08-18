<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiKegiatan extends Model
{
    use HasFactory;
    protected $table = 'lokasi_kegiatan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kelurahan_id',
        'nama',
        'alamat',
        'deskripsi',
        'coordinate',
        'foto',
    ];
}
