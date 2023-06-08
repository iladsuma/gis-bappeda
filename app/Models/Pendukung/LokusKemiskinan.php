<?php

namespace App\Models\Pendukung;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokusKemiskinan extends Model
{
    use HasFactory;

    protected $table = 'lokus_kemiskinan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kelurahan_id',
        'jumlah',
    ];
}
