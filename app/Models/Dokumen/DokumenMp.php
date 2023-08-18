<?php

namespace App\Models\Dokumen;

use App\Models\Administrator\Opd;
use App\Models\Master\LokasiKegiatan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenMp extends Model
{
    use HasFactory;

    protected $table = 'dokumen_mp';
    protected $primaryKey = 'id';
    protected $fillable = [
        'lokasi_kegiatan_id',
        'opd_id',
        'nama_kegiatan',
        'tahun',
        'dokumen',
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class, 'opd_id', 'id');
    }

    public function lokasi()
    {
        return $this->belongsTo(LokasiKegiatan::class, 'lokasi_kegiatan_id', 'id');
    }
}
