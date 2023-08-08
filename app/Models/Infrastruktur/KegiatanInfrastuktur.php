<?php

namespace App\Models\Infrastruktur;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanInfrastuktur extends Model
{
    use HasFactory;
    protected $table = 'kegiatan_infrastruktur';
    protected $primaryKey = 'id';
    protected $fillable = [
        'lokasi_kegiatan_id',
        'opd_id',
        'dokumen_fs_id',
        'dokumen_mp_id',
        'dokumen_lingkungan_id',
        'dokumen_ded_id',
        'nama_realisasi',
        'tahun',
        'aggaran',
        'foto',
    ];
}
