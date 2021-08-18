<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::OrderBy('nama_kelas', 'asc')->get();
        $siswa = Siswa::OrderBy('id', 'asc')->get();
        $jurusan = Jurusan::OrderBy('nama_jurusan', 'asc')->get();
        return view('admin.siswa.index', compact('kelas', 'jurusan', 'siswa'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $id = Crypt::decrypt($id);
        // $user = User::where('siswa_id', $id)->get();
        $siswa = Siswa::findorfail($id);
        $user = User::where('no_induk', $siswa->no_induk)->first();
        // $jurusan = Jurusan::OrderBy('nama_jurusan', 'asc')->get();
        // $jurusan = Jurusan::findorfail($id);
        return view('admin.siswa.details', compact('siswa', 'user'));
    }

    public function show($id)
    {
        // Mengdecrypt id yang dituju atau mendeksripsikan enskripsi yang dituju
        $id = Crypt::decrypt($id);
        // mencari siswa dimana kelas id sama dengan yang ditujukan dan diurutkan berdasarkan nama
        $siswa = Siswa::where('kelas_id', $id)->OrderBy('name', 'asc')->get();
        // mencari field pada tabel kelas berdsrkan id
        $kelas = Kelas::findorfail($id);
        return view('admin.siswa.show', compact('siswa', 'kelas'));
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
        $siswa = Siswa::findorfail($id);
        // memanggil semua field pada tabel kelas dan jurusan
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        return view('admin.siswa.edit', compact('siswa', 'kelas', 'jurusan'));
    }

    public function destroy($id)
    {
        // Mencari siswa dengan id yang dituju berserta menyimpan data untuk dihapus
        $siswa = Siswa::withTrashed()->findorfail($id);
        // menghitung jumlah user dimana no induk yg dituju berserta menyimpan data untuk dihapus
        $countUser = User::withTrashed()->where('no_induk', $siswa->no_induk)->count();
        // Jika hitungan 1 atau lebih
        if ($countUser >= 1) {
            $user = User::withTrashed()->where('no_induk', $siswa->no_induk)->first();
            // akan memaksa data variabel siswa dan user yang disimpan tadi untuk dihapus
            $siswa->forceDelete();
            $user->forceDelete();
            // mengembalikan halaman
            return redirect()->back()->with('success', 'Data siswa berhasil dihapus');
        } else {
            // akan memaksa data variabel siswa dan user yang disimpan tadi untuk dihapus
            $siswa->forceDelete();
            // mengembalikan halaman
            return redirect()->back()->with('success', 'Data siswa berhasil dihapus');
        }
    }

    public function view(Request $request)
    {
        $siswa = Siswa::OrderBy('name', 'asc')->where('kelas_id', $request->id)->get();

        foreach ($siswa as $ss) {
            $newForm[] = array([
                'kelas' => $ss->kelas->nama_kelas,
                'no_induk' => $ss->no_induk,
                'name' => $ss->name,
                'jk' => $ss->jk,
                'foto' => $ss->foto
            ]);
        }

        return response()->json($newForm);
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
            'nama_siswa' => 'required',
            'jk' => 'required',
            'kelas_id' => 'required',
            'email' => 'required',
            'tingkat' => 'required',
            'tgl_lahir' => 'required',
            'telp' => 'required'
        ]);
        
        // Find siswa berdasarkan id yang dituju
        $siswa = Siswa::findorfail($id);
        // Fing user berdasarkan no induk yg dituju
        $user = User::where('no_induk', $siswa->no_induk)->first();

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
                        'name' => $request->nama_siswa,
                        'email' => $request->email,
                        'telp' => $request->telp,
                        'password' => Hash::make($request->password),
                        'foto' => 'uploads/siswa/' . $new_foto
                    ];
                $user->update($user_data);
                } else {
                }
                $siswa_data = [
                    'name' => $request->nama_siswa,
                    'email' => $request->email,
                    'jk' => $request->jk,
                    'kelas_id' => $request->kelas_id,
                    'jurusan_id' => $request->jurusan,
                    'tingkat' => $request->tingkat,
                    'telp' => $request->telp,
                    'tmp_lahir' => $request->tmp_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'foto' => 'uploads/siswa/' . $new_foto
                ];
                $siswa->update($siswa_data);
                // Memindahkan Foto pada folder yang dituju
                $foto->move('uploads/siswa/', $new_foto);
            } else {
                // Jika tidak menginputkan file

                // jika user ditemukan
                if ($user) {
                    $user_data = [
                        'name' => $request->nama_siswa,
                        'email' => $request->email,
                        'telp' => $request->telp,
                        'password' => Hash::make($request->password),
                    ];
                    $user->update($user_data);
                } else {
                }
                $siswa_data = [
                    'name' => $request->nama_siswa,
                    'email' => $request->email,
                    'jk' => $request->jk,
                    'kelas_id' => $request->kelas_id,
                    'jurusan_id' => $request->jurusan,
                    'tingkat' => $request->tingkat,
                    'telp' => $request->telp,
                    'tmp_lahir' => $request->tmp_lahir,
                    'tgl_lahir' => $request->tgl_lahir
                ];
                $siswa->update($siswa_data);
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
                        'name' => $request->nama_siswa,
                        'email' => $request->email,
                        'telp' => $request->telp,
                        'foto' => 'uploads/siswa/' . $new_foto
                    ];
                $user->update($user_data);
                } else {
                }
                $siswa_data = [
                    'name' => $request->nama_siswa,
                    'email' => $request->email,
                    'jk' => $request->jk,
                    'kelas_id' => $request->kelas_id,
                    'jurusan_id' => $request->jurusan,
                    'tingkat' => $request->tingkat,
                    'telp' => $request->telp,
                    'tmp_lahir' => $request->tmp_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'foto' => 'uploads/siswa/' . $new_foto
                ];
                $siswa->update($siswa_data);
                // Memindahkan Foto pada folder yang dituju
                $foto->move('uploads/siswa/', $new_foto);
            } else {
                // Jika tidak menginputkan file

                // jika user ditemukan
                if ($user) {
                    $user_data = [
                        'name' => $request->nama_siswa,
                        'email' => $request->email,
                        'telp' => $request->telp,
                    ];
                    $user->update($user_data);
                } else {
                }
                $siswa_data = [
                    'name' => $request->nama_siswa,
                    'email' => $request->email,
                    'jk' => $request->jk,
                    'kelas_id' => $request->kelas_id,
                    'jurusan_id' => $request->jurusan,
                    'tingkat' => $request->tingkat,
                    'telp' => $request->telp,
                    'tmp_lahir' => $request->tmp_lahir,
                    'tgl_lahir' => $request->tgl_lahir
                ];
                $siswa->update($siswa_data);
            }
        }
        
        // Me redirect atau langsung menuju route yang dituju dengan alert toastr berhasil
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'no_induk' => 'required|string|unique:siswa',
            'name' => 'required',
            'jk' => 'required',
            'kelas_id' => 'required',
            'jurusan_id' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'tingkat' => 'required',
            'telp' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required'
        ]);
        
        // Menghitung jumlah siswa dengan no induk yang dituju
        $countSiswa = Siswa::where('no_induk', $request->no_induk)->count();

        // mendapatkan pada tabel siswa dimana no induk yang dituju
        $siswaId = Siswa::where('no_induk', $request->no_induk)->get();
        // percabangan var siswa id
        foreach ($siswaId as $val) {
            $siswa = Siswa::findorfail($val->id);
        }
        // Jika hitungan jumlah siswa = 1 atau lebih akan gagal
        // Hitungan yang dimaksud adalah jika ada no induk yang sama , proses tidak akan dijalankan atau error 
        if ($countSiswa >= 1) {
            return redirect()->back()->with('error', 'Gagal Menambahkan user Siswa baru!');
        } else {
            if ($request->foto) {
                $foto = $request->foto;
                $new_foto = date('s' . 'i' . 'H' . 'd' . 'm' . 'Y') . "_" . $foto->getClientOriginalName();

                // Untuk membuat field baru pada Tabel Siswa
                Siswa::create([
                    'no_induk' => $request->no_induk,
                    'name' => $request->name,
                    'jk' => $request->jk,
                    'kelas_id' => $request->kelas_id,
                    'jurusan_id' => $request->jurusan_id,
                    'tingkat' => $request->tingkat,
                    'telp' => $request->telp,
                    'email' => $request->email,
                    'tmp_lahir' => $request->tmp_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'foto' => 'uploads/siswa/' . $new_foto
                ]);
                
                // Untuk membuat field baru pada Tabel User
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                    'no_induk' => $request->no_induk,
                    'telp' => $request->telp,
                    'foto' => 'uploads/siswa/' . $new_foto
                ]);
                // Memindahkan Foto pada folder yang dituju
                $foto->move('uploads/siswa/', $new_foto);
            } else {
                // Jika jenis kelamin L / Laki laki akan menampilkan foto default Laki laki
                if ($request->jk == 'L') {
                    $foto = 'uploads/siswa/male.jpg';
                } 
                // Jika jenis kelamin P / Perempuan akan menampilkan foto default Perempuan
                else {
                    $foto = 'uploads/siswa/female.jpg';
                }

                // Untuk membuat field baru pada Tabel Siswa
                Siswa::create([
                    'no_induk' => $request->no_induk,
                    'name' => $request->name,
                    'jk' => $request->jk,
                    'kelas_id' => $request->kelas_id,
                    'jurusan_id' => $request->jurusan_id,
                    'tingkat' => $request->tingkat,
                    'telp' => $request->telp,
                    'email' => $request->email,
                    'tmp_lahir' => $request->tmp_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'foto' => $foto
                ]);

                // Untuk membuat field baru pada Tabel User
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                    'no_induk' => $request->no_induk,
                    'telp' => $request->telp,
                    'foto' => $foto

                ]);
            }
            // Mengembalikan / return ke halaman sebelumnya
            return redirect()->back()->with('success', 'Sukses Menambah User Baru sebagai siswa!');
        }
    }
}