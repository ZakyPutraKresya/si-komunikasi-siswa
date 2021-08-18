<?php

namespace App\Http\Controllers;

use App\Models\KD;
use App\Models\Mapel;
use App\Models\Jurusan;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Kompetensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use PDF;

class KDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kd = KD::groupBy('mapel_id')->get();
        $mapel = Mapel::all();
        $guru = Guru::all();
        return view('admin.kd.index', compact('kd', 'mapel', 'guru'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kd_pengetahuan' => 'required',
            'kd_keterampilan' => 'required',
            'materi_pokok' => 'required',
            'pembelajaran' => 'required',
            'penilaian' => 'required',
            'alokasi_waktu' => 'required',
            'sumber_belajar' => 'required',
            'mapel_id' => 'required',
            'guru_id' => 'required'
        ]);

        KD::create(
            [
                'kd_pengetahuan' => $request->kd_pengetahuan,
                'kd_keterampilan' => $request->kd_keterampilan,
                'materi_pokok' => $request->materi_pokok,
                'pembelajaran' => $request->pembelajaran,
                'penilaian' => $request->penilaian,
                'alokasi_waktu' => $request->alokasi_waktu,
                'sumber_belajar' => $request->sumber_belajar,
                'mapel_id' => $request->mapel_id,
                'guru_id' => $request->guru_id,
            ]
        );

        return redirect()->route('KD.index')->with('success', 'Data mapel berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($mapel_id)
    {
        // Mengdecrypt id yang dituju atau mendeksripsikan enskripsi yang dituju
        $mapel_id = Crypt::decrypt($mapel_id);
        // mencari siswa dimana kelas id sama dengan yang ditujukan dan diurutkan berdasarkan nama
        $kd = KD::where('mapel_id', $mapel_id)->get();
        $namapel = KD::where('mapel_id', $mapel_id)->first();
        $mapel = Mapel::all();
        $guru = Guru::all();
        return view('admin.kd.show', compact('kd', 'namapel', 'guru', 'mapel'));
    }

    public function detail($guru_id)
    {
        // Mengdecrypt id yang dituju atau mendeksripsikan enskripsi yang dituju
        $guru_id = Crypt::decrypt($guru_id);
        // mencari siswa dimana kelas id sama dengan yang ditujukan dan diurutkan berdasarkan nama
        $kd = KD::where('guru_id', $guru_id)->get();
        $namapel = KD::where('guru_id', $guru_id)->first();
        $mapel = Mapel::all();
        $guru = Guru::all();
        return view('admin.kd.details', compact('kd', 'namapel', 'guru', 'mapel'));
    }

    public function cetak_pdf($guru_id)
    {
    	$kd = KD::where('guru_id', $guru_id)->get();
        $kd2 = KD::where('guru_id', $guru_id)->first();
        $guru = Guru::where('id', $guru_id)->get();
        $mapel = Mapel::where('id', $kd2->mapel_id)->first();
        $kompetensi = Kompetensi::all();

    	$pdf = PDF::loadview('kd-cetak-pdf',['kd'=>$kd, 'guru'=>$guru, 'mapel'=>$mapel, 'kompetensi'=>$kompetensi])
            ->setPaper('a4', 'landscape');
    	return $pdf->stream('laporan-pegawai-pdf');
    }
}
