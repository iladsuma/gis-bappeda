<?php

namespace App\Models\Pendukung;

use App\Models\Master\MasterKelurahan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiIpal extends Model
{
    use HasFactory;
    protected $table = 'lokasi_ipal';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kelurahan_id',
        'nama',
        'alamat',
        'tahun',
        'kondisi',
        'jumlah',
        'keluarga',
        'lat',
        'lng',
    ];

    public function kelurahan()
    {
        return $this->belongsTo(MasterKelurahan::class, 'kelurahan_id', 'id');
    }
}
