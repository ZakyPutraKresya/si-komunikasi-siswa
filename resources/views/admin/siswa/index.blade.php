@extends('layouts.app')
@section('heading', 'Data Siswa')
@section('page')
<li class="breadcrumb-item active">Data Siswa</li>
@endsection
@section('content')

<div class="col-md-12">
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".tambahsiswa">
                    <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data Siswa
                </button>
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kelas as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama_kelas }}</td>
                        <td>
                            <a href="{{ route('siswa.show', Crypt::encrypt($data->id)) }}"
                                class="btn btn-info btn-sm"><i class="nav-icon fas fa-search-plus"></i> &nbsp;
                                Details</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->
<!-- Extra large modal -->
<div class="modal fade bd-example-modal-lg tambahsiswa" tabindex="-1" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Siswa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('siswa.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_induk">NISN</label>
                                <input type="text" id="no_induk" name="no_induk"
                                    placeholder="Nomor Induk Siswa Nasional" onkeypress="return inputAngka(event)"
                                    class="form-control @error('NISN') is-invalid @enderror">
                                
                            </div>
                            
                            <div class="form-group">
                                <label for="email">E-Mail</label>
                                <input type="text" id="email" name="email" placeholder="cth: user@tb.com"
                                    onkeypress="return inputAngka(event)"
                                    class="form-control @error('email') is-invalid @enderror" required>
                            </div>
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="foto"
                                            class="custom-file-input form-control @error('foto') is-invalid @enderror" id="foto">
                                        <label class="custom-file-label" for="foto">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tingkat">Tingkat</label>
                                <select id="tingkat" name="tingkat"
                                    class="select2bs4 form-control @error('tingkat') is-invalid @enderror">
                                    <option value="">-- Pilih Tingkat --</option>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama Siswa</label>
                                <input type="text" id="name" placeholder="Nama Lengkap" name="name"
                                    class="form-control @error('name') is-invalid @enderror">
                            </div>
                            <div class="form-group">
                                <label for="jk">Jenis Kelamin</label>
                                <select id="jk" name="jk"
                                    class="select2bs4 form-control @error('jk') is-invalid @enderror">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tmp_lahir">Tempat Lahir</label>
                                <input type="text" id="tmp_lahir" placeholder="cth: Jakarta" name="tmp_lahir"
                                    class="form-control @error('tmp_lahir') is-invalid @enderror">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jurusan_id">Jurusan</label>
                                <select id="jurusan_id" name="jurusan_id"
                                    class="select2bs4 form-control @error('jurusan_id') is-invalid @enderror">
                                    <option value="">-- Pilih Jurusan --</option>
                                    @foreach ($jurusan as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_jurusan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" placeholder="min 8 character"
                                    onkeypress="return inputAngka(event)"
                                    class="form-control @error('password') is-invalid @enderror">
                            </div>
                            <div class="form-group">
                                <label for="password-confirm">Confirm Password</label>
                                <input id="password-confirm" type="password" placeholder="{{ __('Confirm Password') }}"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password_confirmation" autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" id="role" name="role" value="Siswa"
                                    onkeypress="return inputAngka(event)"
                                    class="form-control @error('role') is-invalid @enderror" hidden>
                            </div>
                            <div class="form-group">
                                <label for="kelas_id">Kelas</label>
                                <select id="kelas_id" name="kelas_id"
                                    class="select2bs4 form-control @error('kelas_id') is-invalid @enderror">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($kelas as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="telp">Nomor Telpon/HP</label>
                                <input type="text" id="telp" name="telp" placeholder="cth: 08123456789"
                                    onkeypress="return inputAngka(event)"
                                    class="form-control @error('telp') is-invalid @enderror">
                            </div>
                            <div class="form-group">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" id="tgl_lahir" name="tgl_lahir"
                                    class="form-control @error('tgl_lahir') is-invalid @enderror">
                            </div>
                            
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i
                        class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
                <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp;
                    Tambahkan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataSiswa").addClass("active");
    </script>
@endsection