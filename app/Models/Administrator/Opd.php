<?php

namespace App\Models\Administrator;

use App\Models\Dokumen\DokumenDed;
use App\Models\Dokumen\DokumenFs;
use App\Models\Dokumen\DokumenLingkungan;
use App\Models\Dokumen\DokumenMp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    use HasFactory;

    protected $table = 'master_opd';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
        'alamat',
        'deskripsi',
    ];

    public function dokumenFs()
    {
        return $this->hasMany(DokumenFs::class, 'opd_id', 'id');
    }

    public function dokumenMp()
    {
        return $this->hasMany(DokumenMp::class, 'opd_id', 'id');
    }

    public function dokumenLingkungan()
    {
        return $this->hasMany(DokumenLingkungan::class, 'opd_id', 'id');
    }

    public function dokumenDed()
    {
        return $this->hasMany(DokumenDed::class, 'opd_id', 'id');
    }
}
