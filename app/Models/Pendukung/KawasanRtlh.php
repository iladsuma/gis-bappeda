<?php

namespace App\Models\Pendukung;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KawasanRtlh extends Model
{
    use HasFactory;

    protected $table = 'kawasan_rtlh';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kelurahan_id',
        'jumlah',
    ];
}
