<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guru extends Model
{
    use SoftDeletes;

    protected $fillable = ['nipd', 'nama_guru', 'jabatan', 'email', 'jk', 'telp', 'tmp_lahir', 'tgl_lahir', 'foto'];

    public function mapel()
    {
        return $this->belongsTo('App\Models\Mapel')->withDefault();
    }

    public function kd()
    {
        return $this->belongsTo('App\Models\KD')->withDefault();
    }
    // public function dsk($id)
    // {
    //     $dsk = Nilai::where('guru_id', $id)->first();
    //     return $dsk;
    // }

    protected $table = 'guru';
}
