<?php

namespace App\Models\Administrator;

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
}
