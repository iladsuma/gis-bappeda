<?php

namespace App\Models\Pendukung;

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
    ];
}
