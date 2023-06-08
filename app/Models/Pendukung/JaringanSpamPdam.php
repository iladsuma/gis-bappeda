<?php

namespace App\Models\Pendukung;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JaringanSpamPdam extends Model
{
    use HasFactory;

    protected $table = 'jaringan_spam_pdam';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_jaringan',
        'geometry',
    ];
}
