<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KD extends Model
{
    protected $fillable = ['id', 'kd_pengetahuan', 'kd_keterampilan', 'materi_pokok', 'pembelajaran', 'penilaian', 'alokasi_waktu', 'sumber_belajar', 'guru_id', 'mapel_id'];

    public function mapel()
    {
        return $this->belongsTo('App\Models\Mapel')->withDefault();
    }

    public function guru()
    {
        return $this->belongsTo('App\Models\Guru')->withDefault();
    }
    
    protected $table = 'kd';
}
