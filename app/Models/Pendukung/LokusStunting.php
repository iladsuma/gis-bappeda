<?php

namespace App\Models\Pendukung;

use App\Models\Master\MasterKelurahan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokusStunting extends Model
{
    use HasFactory;

    protected $table = 'lokus_stunting';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kelurahan_id',
        'jumlah',
        'tahun',
    ];

    public function kelurahan()
    {
        return $this->belongsTo(MasterKelurahan::class, 'kelurahan_id', 'id');
    }
}
