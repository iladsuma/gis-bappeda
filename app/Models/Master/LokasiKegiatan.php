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
        return $this->belongsToMany(DokumenFs::class, 'lokasi_dokumen_fs');
    }

    public function dokumen_mp()
    {
        return $this->belongsToMany(DokumenMp::class, 'lokasi_dokumen_mp');
    }

    public function dokumen_ded()
    {
        return $this->belongsToMany(DokumenDed::class, 'lokasi_dokumen_ded');
    }

    public function dokumen_lingkungan()
    {
        return $this->belongsToMany(DokumenLingkungan::class, 'lokasi_dokumen_lingkungan');
    }
}
