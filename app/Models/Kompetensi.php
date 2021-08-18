<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kompetensi extends Model
{
    protected $fillable = ['kompetensi_inti', 'kode_kompetensi'];

    protected $table = 'kompetensi';
}
