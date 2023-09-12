<?php

namespace App\Models\Pendukung;

use App\Models\Master\MasterKelurahan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiSumurPdam extends Model
{
    use HasFactory;
    protected $table = 'lokasi_sumur_pdam';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
        'alamat',
        'kelurahan_id',
        'lat',
        'lng',
    ];

    public function kelurahan()
    {
        return $this->belongsTo(MasterKelurahan::class, 'kelurahan_id', 'id');
    }
}
