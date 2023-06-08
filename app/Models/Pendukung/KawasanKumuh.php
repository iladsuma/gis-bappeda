<?php

namespace App\Models\Pendukung;

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
    ];
}
