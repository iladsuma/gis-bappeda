<?php

namespace App\Models\Master;

use App\Models\Dokumen\DokumenDed;
use App\Models\Dokumen\DokumenFs;
use App\Models\Dokumen\DokumenLingkungan;
use App\Models\Dokumen\DokumenMp;
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

    public function kelurahan()
    {
        return $this->belongsTo(MasterKelurahan::class, 'kelurahan_id', 'id');
    }

    public function dokumen_fs()
    {
        return $this->hasMany(DokumenFs::class, 'lokasi_kegiatan_id', 'id');
    }

    public function dokumen_mp()
    {
        return $this->hasMany(DokumenMp::class, 'lokasi_kegiatan_id', 'id');
    }

    public function dokumen_ded()
    {
        return $this->hasMany(DokumenDed::class, 'lokasi_kegiatan_id', 'id');
    }

    public function dokumen_lingkungan()
    {
        return $this->hasMany(DokumenLingkungan::class, 'lokasi_kegiatan_id', 'id');
    }
}
