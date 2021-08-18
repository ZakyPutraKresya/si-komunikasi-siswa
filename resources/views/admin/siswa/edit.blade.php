@extends('layouts.app')
@section('heading', 'Edit Siswa')
@section('page')
<li class="breadcrumb-item active"><a href="{{ route('siswa.index') }}">Siswa</a></li>
<li class="breadcrumb-item active">Edit Siswa</li>
@endsection
@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Data Siswa</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('siswa.update', $siswa->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_induk">NISN</label>
                            <input type="text" id="no_induk" name="no_induk" value="{{ $siswa->no_induk }}"
                                class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">Nama Siswa</label>
                            <input type="text" id="nama_siswa" name="nama_siswa" value="{{ $siswa->name }}"
                                class="form-control @error('name') is-invalid @enderror">
                        </div>
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select id="jk" name="jk" class="select2bs4 form-control @error('jk') is-invalid @enderror">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="L" @if ($siswa->jk == 'L')
                                    selected
                                    @endif
                                    >Laki-Laki</option>
                                <option value="P" @if ($siswa->jk == 'P')
                                    selected
                                    @endif
                                    >Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tmp_lahir">Tempat Lahir</label>
                            <input type="text" id="tmp_lahir" name="tmp_lahir" value="{{ $siswa->tmp_lahir }}"
                                class="form-control @error('tmp_lahir') is-invalid @enderror">
                        </div>
                        <div class="form-group">
                            <label for="tingkat">Tingkat</label>
                            <select id="tingkat" name="tingkat"
                                class="select2bs4 form-control @error('tingkat') is-invalid @enderror">
                                <option value="">-- Pilih Tingkat --</option>
                                <option value="X" @if ($siswa->tingkat == 'X')
                                    selected
                                    @endif
                                    >X (Sepuluh)</option>
                                <option value="XI" @if ($siswa->tingkat == 'XI')
                                    selected
                                    @endif
                                    >XI (Sebelas)</option>
                                <option value="XII" @if ($siswa->tingkat == 'XII')
                                    selected
                                    @endif
                                    >XII (Dua Belas)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="foto"
                                        class="custom-file-input @error('foto') is-invalid @enderror" title="Awikwok"
                                        id="foto">
                                    <label class="custom-file-label" for="foto">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" value="{{ $siswa->email }}" class="form-control @error('email') is-invalid @enderror">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="Kosongkan jk tdk ingin ganti"
                                class="form-control @error('password') is-invalid @enderror">
                        </div>
                        <div class="form-group">
                            <label for="kelas_id">Kelas</label>
                            <select id="kelas_id" name="kelas_id"
                                class="select2bs4 form-control @error('kelas_id') is-invalid @enderror">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($kelas as $data)
                                <option value="{{ $data->id }}" @if ($siswa->kelas_id == $data->id)
                                    selected
                                    @endif
                                    >{{ $data->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="telp">Nomor Telpon/HP</label>
                            <input type="text" id="telp" name="telp" value="{{ $siswa->telp }}"
                                onkeypress="return inputAngka(event)"
                                class="form-control @error('telp') is-invalid @enderror">
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" id="tgl_lahir" name="tgl_lahir" value="{{ $siswa->tgl_lahir }}"
                                class="form-control @error('tgl_lahir') is-invalid @enderror">
                        </div>
                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <select id="jurusan" name="jurusan"
                                class="select2bs4 form-control @error('jurusan') is-invalid @enderror">
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach ($jurusan as $data)
                                <option value="{{ $data->id }}" @if ($siswa->jurusan_id == $data->id)
                                    selected
                                    @endif
                                    >{{ $data->nama_jurusan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="#" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i>
                    &nbsp; Kembali</a> &nbsp;
                <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp;
                    Update</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#back').click(function () {
            window.location = "{{ route('siswa.show', Crypt::encrypt($siswa->kelas_id)) }}";
        });
    });
    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#DataSiswa").addClass("active");
</script>
@endsection