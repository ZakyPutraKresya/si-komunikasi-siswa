<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::OrderBy('nama_kelas', 'asc')->get();
        $guru = Guru::OrderBy('nama_guru', 'asc')->get();
        $jurusan = Jurusan::all();
        $siswa = Siswa::OrderBy('name', 'asc')->get();
        return view('admin.kelas.index', compact('kelas', 'guru', 'jurusan', 'siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $guru = Guru::OrderBy('nama_guru', 'asc')->get();
        return view('admin.kelas.create', compact('guru'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->id != '') {
            $this->validate($request, [
                'nama_kelas' => 'required|min:6|max:10',
                'jurusan_id' => 'required',
                'guru_id' => 'required|unique:kelas',
            ]);
        } else {
            $this->validate($request, [
                'nama_kelas' => 'required|unique:kelas|min:6|max:10',
                'jurusan_id' => 'required',
                'guru_id' => 'required|unique:kelas',
            ]);
        }

        Kelas::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'nama_kelas' => $request->nama_kelas,
                'jurusan_id' => $request->jurusan_id,
                'guru_id' => $request->guru_id,
            ]
        );

        return redirect()->back()->with('success', 'Data kelas berhasil diperbarui!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Mengdecrypt id yang dituju atau mendeksripsikan enskripsi yang dituju
        $id = Crypt::decrypt($id);
        // mencari siswa berdsrkan id
        // $siswa = Siswa::findorfail($id);
        // memanggil semua field pada tabel kelas dan jurusan
        $kelas = Kelas::findorfail($id);
        $jurusan = Jurusan::all();
        $guru = Guru::all();
        return view('admin.kelas.edit', compact('kelas', 'jurusan', 'guru'));
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
        $this->validate($request, [
            'nama_kelas' => 'required',
            'jurusan_id' => 'required',
            'guru_id' => 'required',
        ]);

        // Find kelas berdasarkan id yang dituju
        $kelas = Kelas::findorfail($id);

        $kelas_data = [
            'nama_kelas' => $request->nama_kelas,
            'jurusan_id' => $request->jurusan_id,
            'guru_id' => $request->guru_id,
        ];
        $kelas->update($kelas_data);

         // Me redirect atau langsung menuju route yang dituju dengan alert toastr berhasil
         return redirect()->route('kelas.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = Kelas::withTrashed()->findorfail($id);
        $siswa = Siswa::withTrashed()->where('kelas_id', $kelas->id)->get();
        $countSiswa = Siswa::withTrashed()->where('kelas_id', $kelas->id)->count();
        if ($countSiswa >= 1) {
            Siswa::withTrashed()->where('kelas_id', $kelas->id)->forceDelete();
        } else {
        }
        foreach ($siswa as $data){
            $countUser = User::withTrashed()->where('no_induk', $data->no_induk)->count();
        if ($countUser >= 1){
            User::withTrashed()->where('no_induk', $data->no_induk)->forceDelete();
        } else {
        }
        }
        $kelas->forceDelete();
        return redirect()->back()->with('success', 'Data kelas berhasil dihapus secara permanent');
    }


}
