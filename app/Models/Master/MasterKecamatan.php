<?php

namespace App\Models\Master;

use App\Models\Pendukung\KawasanKumuh;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterKecamatan extends Model
{
    use HasFactory;

    protected $table = 'master_kecamatan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
        'kode',
    ];

    public function kelurahan()
    {
        return $this->hasMany(MasterKelurahan::class, 'kecamatan_id', 'id');
    }
}
