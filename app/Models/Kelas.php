<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use SoftDeletes;

    protected $fillable = ['jurusan_id', 'nama_kelas', 'guru_id'];

    public function guru()
    {
        return $this->belongsTo('App\Models\Guru')->withDefault();
    }

    public function jurusan()
    {
        return $this->belongsTo('App\Models\Jurusan')->withDefault();
    }

    public function siswa()
    {
        return $this->belongsTo('App\Models\Siswa')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User')->withDefault();
    }

    protected $table = 'kelas';
}
