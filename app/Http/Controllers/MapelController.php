<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Jurusan;
use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mapel = Mapel::groupBy('nama_mapel')->get();
        $jurusan = Jurusan::all();
        $guru = Guru::all();
        return view('admin.mapel.index', compact('mapel', 'jurusan', 'guru'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
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
            'nama_mapel' => 'required',
            'jurusan_id' => 'required',
            'guru_id' => 'required'
        ]);

        Mapel::create(
            [
                'nama_mapel' => $request->nama_mapel,
                'jurusan_id' => $request->jurusan_id,
                'guru_id' => $request->guru_id,
            ]
        );

        return redirect()->route('mapel.index')->with('success', 'Data mapel berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nama_mapel)
    {
        // Mengdecrypt id yang dituju atau mendeksripsikan enskripsi yang dituju
        $nama_mapel = Crypt::decrypt($nama_mapel);
        // mencari siswa dimana kelas id sama dengan yang ditujukan dan diurutkan berdasarkan nama
        $mapel = Mapel::where('nama_mapel', $nama_mapel)->OrderBy('nama_mapel', 'asc')->get();
        $jurusan = Jurusan::all();
        return view('admin.mapel.show', compact('mapel', 'jurusan' ,'nama_mapel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $mapel = Mapel::findorfail($id);
        $guru = Guru::all();
        $jurusan = Jurusan::all();
        return view('admin.mapel.edit', compact('mapel', 'jurusan', 'guru'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mapel = Mapel::withTrashed()->findorfail($id);
        // $countJadwal = Jadwal::where('mapel_id', $mapel->id)->count();
        // if ($countJadwal >= 1) {
        //     $jadwal = Jadwal::where('mapel_id', $mapel->id)->delete();
        // } else {
        // }
        // $countGuru = Guru::where('mapel_id', $mapel->id)->count();
        // if ($countGuru >= 1) {
        //     $guru = Guru::where('mapel_id', $mapel->id)->delete();
        // } else {
        // }
        $mapel->forceDelete();
        return redirect()->back()->with('success', 'Data mapel berhasil dihapus secara permanent');
    }


    public function getMapelJson(Request $request)
    {
        $jadwal = Jadwal::OrderBy('mapel_id', 'asc')->where('kelas_id', $request->kelas_id)->get();
        $jadwal = $jadwal->groupBy('mapel_id');

        foreach ($jadwal as $val => $data) {
            $newForm[] = array(
                'mapel' => $data[0]->pelajaran($val)->nama_mapel,
                'guru' => $data[0]->pengajar($data[0]->guru_id)->id
            );
        }

        return response()->json($newForm);
    }
}
