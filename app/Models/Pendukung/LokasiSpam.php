<?php

namespace App\Models\Pendukung;

use App\Models\Master\MasterKelurahan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiSpam extends Model
{
    use HasFactory;
    protected $table = 'lokasi_spam';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kelurahan_id',
        'nama',
        'alamat',
        'tahun',
        'terpasang',
        'aktif',
        'lat',
        'lng',
        'image',
    ];

    public function kelurahan()
    {
        return $this->belongsTo(MasterKelurahan::class, 'kelurahan_id', 'id');
    }
}
