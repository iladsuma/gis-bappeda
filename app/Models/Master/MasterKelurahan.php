<?php

namespace App\Models\Master;

use App\Models\Pendukung\KawasanKumuh;
use App\Models\Pendukung\KawasanRtlh;
use App\Models\Pendukung\LokusKemiskinan;
use App\Models\Pendukung\LokusStunting;
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

    public function kawasan_kumuh()
    {
        return $this->hasOne(KawasanKumuh::class, 'kelurahan_id', 'id');
    }

    public function kawasan_rtlh()
    {
        return $this->hasOne(KawasanRtlh::class, 'kelurahan_id', 'id');
    }

    public function lokus_kemiskinan()
    {
        return $this->hasOne(LokusKemiskinan::class, 'kelurahan_id', 'id');
    }

    public function lokus_stunting()
    {
        return $this->hasOne(LokusStunting::class, 'kelurahan_id', 'id');
    }
}
