<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mapel extends Model
{
    use SoftDeletes;

    protected $fillable = ['id', 'nama_mapel', 'jurusan_id', 'guru_id'];

    public function jurusan()
    {
        return $this->belongsTo('App\Models\Jurusan')->withDefault();
    }

    public function kd()
    {
        return $this->belongsTo('App\Models\KD')->withDefault();
    }

    public function guru()
    {
        return $this->belongsTo('App\Models\Guru')->withDefault();
    }

    // public function sikap($id)
    // {
    //     $siswa = Siswa::where('no_induk', Auth::user()->no_induk)->first();
    //     $nilai = Sikap::where('siswa_id', $siswa->id)->where('mapel_id', $id)->first();
    //     return $nilai;
    // }

    // public function cekSikap($id)
    // {
    //     $data = json_decode($id, true);
    //     $sikap = Sikap::where('siswa_id', $data['siswa'])->where('mapel_id', $data['mapel'])->first();
    //     return $sikap;
    // }

    protected $table = 'mapel';
}
