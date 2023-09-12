<?php

namespace App\Models\Pendukung;

use App\Models\Master\MasterKecamatan;
use App\Models\Master\MasterKelurahan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KawasanKumuh extends Model
{
    use HasFactory;

    protected $table = 'kawasan_kumuh';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kelurahan_id',
        'jumlah',
        'tingkat_kumuh',
        'luas',
        'tahun',
    ];

    public function kelurahan()
    {
        return $this->belongsTo(MasterKelurahan::class, 'kelurahan_id', 'id');
    }
}
