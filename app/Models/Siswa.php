<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use SoftDeletes;

    protected $fillable = ['no_induk', 'name', 'kelas_id', 'jk', 'telp', 'tmp_lahir', 'tgl_lahir', 'foto', 'email', 'tingkat', 'jurusan_id'];

    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas')->withDefault();
    }

    public function jurusan()
    {
        return $this->belongsTo('App\Models\Jurusan')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User')->withDefault();
    }

    // public function ulangan($id)
    // {
    //     $guru = Guru::where('id_card', Auth::user()->id_card)->first();
    //     $nilai = Ulangan::where('siswa_id', $id)->where('guru_id', $guru->id)->first();
    //     return $nilai;
    // }

    // public function sikap($id)
    // {
    //     $guru = Guru::where('id_card', Auth::user()->id_card)->first();
    //     $nilai = Sikap::where('siswa_id', $id)->where('guru_id', $guru->id)->first();
    //     return $nilai;
    // }

    // public function nilai($id)
    // {
    //     $guru = Guru::where('id_card', Auth::user()->id_card)->first();
    //     $nilai = Rapot::where('siswa_id', $id)->where('guru_id', $guru->id)->first();
    //     return $nilai;
    // }

    protected $table = 'siswa';
}
