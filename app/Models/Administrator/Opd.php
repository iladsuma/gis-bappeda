<?php

namespace App\Models\Administrator;

use App\Models\Dokumen\DokumenFs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    use HasFactory;

    protected $table = 'master_opd';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
        'alamat',
        'deskripsi',
    ];

    public function dokumenFs()
    {
        return $this->hasMany(DokumenFs::class, 'opd_id', 'id');
    }
}
