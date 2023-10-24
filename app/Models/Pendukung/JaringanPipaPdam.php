<?php

namespace App\Models\Pendukung;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JaringanPipaPdam extends Model
{
    use HasFactory;

    protected $table = 'jaringan_pipa_pdam';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
    ];
}
