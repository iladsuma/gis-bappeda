<?php

namespace App\Models\Dokumen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenFs extends Model
{
    use HasFactory;

    protected $table = 'dokumen_fs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'lokasi_kegiatan_id',
        'opd_id',
        'nama_kegiatan',
        'tahun',
        'dokumen',
    ];
}
