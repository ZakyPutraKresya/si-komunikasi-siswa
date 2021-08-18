<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guru = Guru::groupBy('jabatan')->get();
        return view('admin.guru.index', compact('guru'));
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
            'nipd' => 'required|string|unique:guru',
            'nama_guru' => 'required',
            'jk' => 'required',
            'jabatan' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'telp' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required'
        ]);
        
        // Menghitung jumlah siswa dengan no induk yang dituju
        $countGuru = Guru::where('nipd', $request->nipd)->count();

        // mendapatkan pada tabel siswa dimana no induk yang dituju
        $guruId = Guru::where('nipd', $request->nipd)->get();
        // percabangan var siswa id
        foreach ($guruId as $val) {
            $guru = Guru::findorfail($val->id);
        }
        // Jika hitungan jumlah siswa = 1 atau lebih akan gagal
        // Hitungan yang dimaksud adalah jika ada no induk yang sama , proses tidak akan dijalankan atau error 
        if ($countGuru >= 1) {
            return redirect()->back()->with('error', 'Gagal Menambahkan user Karyawan baru!');
        } else {
            if ($request->foto) {
                $foto = $request->foto;
                $new_foto = date('s' . 'i' . 'H' . 'd' . 'm' . 'Y') . "_" . $foto->getClientOriginalName();

                // Untuk membuat field baru pada Tabel Siswa
                Guru::create([
                    'nipd' => $request->nipd,
                    'nama_guru' => $request->nama_guru,
                    'jk' => $request->jk,
                    'jabatan' => $request->jabatan,
                    'telp' => $request->telp,
                    'email' => $request->email,
                    'tmp_lahir' => $request->tmp_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'foto' => 'uploads/guru/' . $new_foto
                ]);
                
                // Untuk membuat field baru pada Tabel User
                User::create([
                    'name' => $request->nama_guru,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                    'no_induk' => $request->nipd,
                    'telp' => $request->telp,
                    'foto' => 'uploads/guru/' . $new_foto
                ]);
                // Memindahkan Foto pada folder yang dituju
                $foto->move('uploads/guru/', $new_foto);
            } else {
                // Jika jenis kelamin L / Laki laki akan menampilkan foto default Laki laki
                if ($request->jk == 'L') {
                    $foto = 'uploads/guru/male.jpg';
                } 
                // Jika jenis kelamin P / Perempuan akan menampilkan foto default Perempuan
                else {
                    $foto = 'uploads/guru/female.jpg';
                }

                // Untuk membuat field baru pada Tabel Siswa
                Guru::create([
                    'nipd' => $request->nipd,
                    'nama_guru' => $request->nama_guru,
                    'jk' => $request->jk,
                    'jabatan' => $request->jabatan,
                    'telp' => $request->telp,
                    'email' => $request->email,
                    'tmp_lahir' => $request->tmp_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'foto' => $foto
                ]);

                // Untuk membuat field baru pada Tabel User
                User::create([
                    'name' => $request->nama_guru,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                    'no_induk' => $request->nipd,
                    'telp' => $request->telp,
                    'foto' => $foto

                ]);
            }
            // Mengembalikan / return ke halaman sebelumnya
            return redirect()->back()->with('success', 'Sukses Menambah User Baru!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($jabatan)
    {
        // $jabatan = Crypt::decrypt($jabatan);
        $guru = Guru::where('jabatan', $jabatan)->OrderBy('nama_guru', 'asc')->get();
        return view('admin.guru.show', compact('guru', 'jabatan'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $guru = Guru::findorfail($id);
        return view('admin.guru.details', compact('guru'));
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
        $guru = Guru::findorfail($id);
        $mapel = Mapel::all();
        return view('admin.guru.edit', compact('guru', 'mapel'));
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
            'nipd' => 'required',
            'nama_guru' => 'required',
            'jk' => 'required',
            'email' => 'required',
            'tgl_lahir' => 'required',
            'telp' => 'required'
        ]);
        
        // Find siswa berdasarkan id yang dituju
        $guru = Guru::findorfail($id);
        // Fing user berdasarkan no induk yg dituju
        $user = User::where('no_induk', $guru->nipd)->first();

        if($request->password){
            // Jika input file foto
            if ($request->foto) {
                // Membuat variabel foto dengan value yang diinputkan
                $foto = $request->foto;
                // Membuat variabel foto baru dengan value tanggal hari ini + var foto nama asli si File inputan
                $new_foto = date('s' . 'i' . 'H' . 'd' . 'm' . 'Y') . "_" . $foto->getClientOriginalName();

                // Jika find user ditemukan
                if ($user) {
                    $user_data = [
                        'no_induk' => $request->nipd,
                        'name' => $request->nama_guru,
                        'email' => $request->email,
                        'telp' => $request->telp,
                        'password' => Hash::make($request->password),
                        'role' => $request->role,
                        'foto' => 'uploads/guru/' . $new_foto
                    ];
                $user->update($user_data);
                } else {
                }
                $guru_data = [
                    'nipd' => $request->nipd,
                    'nama_guru' => $request->nama_guru,
                    'email' => $request->email,
                    'jk' => $request->jk,
                    'jabatan' => $request->jabatan,
                    'telp' => $request->telp,
                    'tmp_lahir' => $request->tmp_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'foto' => 'uploads/guru/' . $new_foto
                ];
                $guru->update($guru_data);
                // Memindahkan Foto pada folder yang dituju
                $foto->move('uploads/guru/', $new_foto);
            } else {
                // Jika tidak menginputkan file

                // jika user ditemukan
                if ($user) {
                    $user_data = [
                        'no_induk' => $request->nipd,
                        'name' => $request->nama_guru,
                        'email' => $request->email,
                        'telp' => $request->telp,
                        'password' => Hash::make($request->password),
                        'role' => $request->role
                    ];
                    $user->update($user_data);
                } else {
                }
                $guru_data = [
                    'nipd' => $request->nipd,
                    'nama_guru' => $request->nama_guru,
                    'email' => $request->email,
                    'jk' => $request->jk,
                    'jabatan' => $request->jabatan,
                    'telp' => $request->telp,
                    'tmp_lahir' => $request->tmp_lahir,
                    'tgl_lahir' => $request->tgl_lahir
                ];
                $guru->update($guru_data);
            }
        } else {
            // Jika input file foto
            if ($request->foto) {
                // Membuat variabel foto dengan value yang diinputkan
                $foto = $request->foto;
                // Membuat variabel foto baru dengan value tanggal hari ini + var foto nama asli si File inputan
                $new_foto = date('s' . 'i' . 'H' . 'd' . 'm' . 'Y') . "_" . $foto->getClientOriginalName();

                // Jika find user ditemukan
                if ($user) {
                    $user_data = [
                        'no_induk' => $request->nipd,
                        'name' => $request->nama_guru,
                        'email' => $request->email,
                        'telp' => $request->telp,
                        'role' => $request->role,
                        'foto' => 'uploads/guru/' . $new_foto
                    ];
                $user->update($user_data);
                } else {
                }
                $guru_data = [
                    'nipd' => $request->nipd,
                    'nama_guru' => $request->nama_guru,
                    'email' => $request->email,
                    'jk' => $request->jk,
                    'jabatan' => $request->jabatan,
                    'telp' => $request->telp,
                    'tmp_lahir' => $request->tmp_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'foto' => 'uploads/guru/' . $new_foto
                ];
                $guru->update($guru_data);
                // Memindahkan Foto pada folder yang dituju
                $foto->move('uploads/guru/', $new_foto);
            } else {
                // Jika tidak menginputkan file

                // jika user ditemukan
                if ($user) {
                    $user_data = [
                        'no_induk' => $request->nipd,
                        'name' => $request->nama_guru,
                        'email' => $request->email,
                        'telp' => $request->telp,
                        'role' => $request->role
                    ];
                    $user->update($user_data);
                } else {
                }
                $guru_data = [
                    'nipd' => $request->nipd,
                    'nama_guru' => $request->nama_guru,
                    'email' => $request->email,
                    'jk' => $request->jk,
                    'jabatan' => $request->jabatan,
                    'telp' => $request->telp,
                    'tmp_lahir' => $request->tmp_lahir,
                    'tgl_lahir' => $request->tgl_lahir
                ];
                $guru->update($guru_data);
            }
        }
        
        // Me redirect atau langsung menuju route yang dituju dengan alert toastr berhasil
        return redirect()->route('guru.index')->with('success', 'Data Karyawan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $guru = Guru::withTrashed()->findorfail($id);
        $countMapel = Mapel::withTrashed()->where('guru_id', $guru->id)->count();
        if ($countMapel >= 1) {
            $mapel = Mapel::withTrashed()->where('guru_id', $guru->id)->forceDelete();
        } else {
        }
        $countUser = User::withTrashed()->where('no_induk', $guru->nipd)->count();
        if ($countUser >= 1) {
            $user = User::withTrashed()->where('no_induk', $guru->nipd)->forceDelete();
        } else {
        }
        $countKelas = Kelas::withTrashed()->where('guru_id', $guru->id)->count();
        if ($countKelas >= 1) {
            $kelas = Kelas::withTrashed()->where('guru_id', $guru->id)->forceDelete();
        } else {
        }
        $guru->forceDelete();
        return redirect()->back()->with('success', 'Data guru berhasil dihapus');
    }

    
}
