<?php

namespace App\Models\Master;

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
}
