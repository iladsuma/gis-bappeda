<?php

namespace App\Models\Master;

use App\Models\Pendukung\KawasanKumuh;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterKelurahan extends Model
{
    use HasFactory;

    protected $table = 'master_kelurahan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kecamatan_id',
        'nama',
        'kode',
        'geometry',
    ];

    public function kecamatan()
    {
        return $this->belongsTo(MasterKecamatan::class, 'kecamatan_id', 'id');
    }

    public function kawasankumuh()
    {
        return $this->hasMany(KawasanKumuh::class, 'kelurahan_id', 'id');
    }
}
