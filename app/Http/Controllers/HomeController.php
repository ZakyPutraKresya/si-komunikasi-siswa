<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function admin()
    {
        $guru = Guru::count();
        $gurulk = Guru::where('jk', 'L')->count();
        $gurupr = Guru::where('jk', 'P')->count();
        $siswa = Siswa::count();
        $siswalk = Siswa::where('jk', 'L')->count();
        $siswapr = Siswa::where('jk', 'P')->count();
        $kelas = Kelas::count();
        $rpl = Siswa::where('jurusan_id', '1')->count();
        $tkj = Siswa::where('jurusan_id', '2')->count();
        $bc = Siswa::where('jurusan_id', '5')->count();
        $mm = Siswa::where('jurusan_id', '4')->count();
        $tei = Siswa::where('jurusan_id', '3')->count();
        $user = User::count();
        $jurusan = Jurusan::all();
        $htgjurusan = Jurusan::count();
        $mapel = Mapel::groupBy('nama_mapel')->count();
        return view('admin.index', compact(
            'guru',
            'gurulk',
            'gurupr',
            'siswalk',
            'siswapr',
            'siswa',
            'kelas',
            'rpl',
            'tkj',
            'mm',
            'bc',
            'tei',
            'user',
            'jurusan',
            'htgjurusan',
            'mapel'
        ));
    }
}
